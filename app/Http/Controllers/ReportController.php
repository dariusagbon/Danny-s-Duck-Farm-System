<?php

namespace App\Http\Controllers;

use App\Exports\ArrayExport;
use App\Models\Eggs;
use App\Models\feeds as Feed;
use App\Models\InventoryLog;
use App\Models\sales as Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function salesIndex(Request $request)
    {
        $period = $request->query('period', 'monthly');
        $sales = Sale::with('customer')
            ->orderBy('month_of', 'desc')
            ->paginate(20);

        return view('reports.sales', compact('sales', 'period'));
    }

    public function salesPdf(Request $request)
    {
        $sales = Sale::with('customer')->orderBy('month_of', 'desc')->get();
        $report = Pdf::loadView('reports.sales-pdf', compact('sales'));

        return $report->download('sales-report.pdf');
    }

    public function salesExcel(Request $request)
    {
        $sales = Sale::with('customer')->orderBy('month_of', 'desc')->get();
        $rows = $sales->map(function ($sale) {
            return [
                'Date' => $sale->month_of->format('Y-m-d'),
                'Customer' => optional($sale->customer)->name,
                'Eggs Sold' => $sale->total_eggs_sold,
                'Trays' => $sale->total_trays,
                'Price' => $sale->selling_price,
                'Gross Income' => $sale->gross_income,
                'Expenses' => $sale->total_expenses,
                'Net Income' => $sale->net_income,
            ];
        });

        return Excel::download(new ArrayExport($rows, array_keys($rows->first()->toArray() ?? [])), 'sales-report.xlsx');
    }

    public function inventoryPdf(Request $request)
    {
        $eggStock = Eggs::orderBy('egg_type')->get();
        $feedsStock = Feed::orderBy('name')->get();

        $report = Pdf::loadView('reports.inventory-pdf', compact('eggStock', 'feedsStock'));
        return $report->download('inventory-report.pdf');
    }

    public function inventoryExcel(Request $request)
    {
        $eggRows = Eggs::orderBy('egg_type')->get()->map(fn($egg) => [
            'Type' => $egg->egg_type,
            'Quantity' => $egg->quantity,
            'Current Stock' => $egg->current_stock,
            'Min Stock' => $egg->min_stock_level,
            'Price' => $egg->price,
        ]);

        $feedRows = Feed::orderBy('name')->get()->map(fn($feed) => [
            'Name' => $feed->name,
            'Current Stock' => $feed->current_stock,
            'Min Stock' => $feed->min_stock_level,
            'Unit' => $feed->unit,
            'Price' => $feed->price,
        ]);

        $rows = $eggRows->merge([[ 'Type' => '---', 'Quantity' => '', 'Current Stock' => '', 'Min Stock' => '', 'Price' => '' ]])->merge($feedRows);
        return Excel::download(new ArrayExport($rows, array_keys($rows->first()->toArray() ?? [])), 'inventory-report.xlsx');
    }

    public function dailyEggsIndex(Request $request)
    {
        $date = $request->query('date', now()->format('Y-m-d'));
        $eggs = Eggs::whereDate('date', $date)->orderBy('created_at', 'desc')->paginate(20);
        $totalProduction = Eggs::whereDate('date', $date)->sum('quantity');

        return view('reports.daily-eggs', compact('eggs', 'date', 'totalProduction'));
    }

    public function dailyEggsPdf(Request $request)
    {
        $date = $request->query('date', now()->format('Y-m-d'));
        $eggs = Eggs::whereDate('date', $date)->orderBy('created_at', 'desc')->get();
        $totalProduction = Eggs::whereDate('date', $date)->sum('quantity');

        $report = Pdf::loadView('reports.daily-eggs-pdf', compact('eggs', 'date', 'totalProduction'));
        return $report->download("daily-eggs-report-{$date}.pdf");
    }

    public function dailyEggsExcel(Request $request)
    {
        $date = $request->query('date', now()->format('Y-m-d'));
        $eggs = Eggs::whereDate('date', $date)->orderBy('created_at', 'desc')->get();
        $rows = $eggs->map(function ($egg) {
            return [
                'Date' => $egg->date->format('Y-m-d'),
                'Egg Type' => $egg->egg_type,
                'Quantity' => $egg->quantity,
                'Price' => $egg->price,
                'Current Stock' => $egg->current_stock,
            ];
        });

        return Excel::download(new ArrayExport($rows, array_keys($rows->first()->toArray() ?? [])), "daily-eggs-report-{$date}.xlsx");
    }

    public function dailyFeedsIndex(Request $request)
    {
        $date = $request->query('date', now()->format('Y-m-d'));
        $feedConsumption = InventoryLog::where('item_type', Feed::class)
            ->where('quantity_change', '<', 0)
            ->whereDate('created_at', $date)
            ->with('item')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $totalConsumption = InventoryLog::where('item_type', Feed::class)
            ->where('quantity_change', '<', 0)
            ->whereDate('created_at', $date)
            ->sum('quantity_change') * -1;

        return view('reports.daily-feeds', compact('feedConsumption', 'date', 'totalConsumption'));
    }

    public function dailyFeedsPdf(Request $request)
    {
        $date = $request->query('date', now()->format('Y-m-d'));
        $feedConsumption = InventoryLog::where('item_type', Feed::class)
            ->where('quantity_change', '<', 0)
            ->whereDate('created_at', $date)
            ->with('item')
            ->orderBy('created_at', 'desc')
            ->get();
        $totalConsumption = InventoryLog::where('item_type', Feed::class)
            ->where('quantity_change', '<', 0)
            ->whereDate('created_at', $date)
            ->sum('quantity_change') * -1;

        $report = Pdf::loadView('reports.daily-feeds-pdf', compact('feedConsumption', 'date', 'totalConsumption'));
        return $report->download("daily-feeds-report-{$date}.pdf");
    }

    public function dailyFeedsExcel(Request $request)
    {
        $date = $request->query('date', now()->format('Y-m-d'));
        $feedConsumption = InventoryLog::where('item_type', Feed::class)
            ->where('quantity_change', '<', 0)
            ->whereDate('created_at', $date)
            ->with('item')
            ->orderBy('created_at', 'desc')
            ->get();
        $rows = $feedConsumption->map(function ($log) {
            return [
                'Date' => $log->created_at->format('Y-m-d'),
                'Feed Name' => $log->item->name,
                'Consumed Quantity' => abs($log->quantity_change),
                'Unit' => $log->item->unit,
            ];
        });

        return Excel::download(new ArrayExport($rows, array_keys($rows->first()->toArray() ?? [])), "daily-feeds-report-{$date}.xlsx");
    }
}

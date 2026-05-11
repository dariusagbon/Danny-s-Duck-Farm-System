<?php

namespace App\Http\Controllers;

use App\Models\Duck;
use App\Models\Eggs;
use App\Models\Expense;
use App\Models\feeds as Feed;
use App\Models\InventoryLog;
use App\Models\Notification;
use App\Models\sales as Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->startOfDay();
        $sixMonthsAgo = now()->subMonths(5)->startOfMonth();

        $totalDucks = Duck::count();
        $activeDucks = Duck::where('status', 'active')->count();
        $totalEggProduction = Eggs::sum('quantity');
        $availableEggStock = Eggs::sum('current_stock');
        $totalFeedStock = Feed::sum('current_stock');
        $monthlySales = Sale::where('month_of', '>=', $sixMonthsAgo)->selectRaw('DATE_FORMAT(month_of, "%Y-%m") as month, SUM(net_income) as net_income')->groupBy('month')->orderBy('month')->get();
        $dailySales = Sale::whereDate('created_at', $today)->sum('net_income');
        $monthlyIncome = Sale::whereMonth('month_of', now()->month)->whereYear('month_of', now()->year)->sum('net_income');
        $grossSales = Sale::sum('gross_income');
        $netIncome = Sale::sum('net_income');
        $totalExpenses = Expense::sum('amount');
        $dailyEggProduction = Eggs::whereDate('date', $today)->sum('quantity');
        $dailyFeedConsumption = InventoryLog::where('item_type', Feed::class)
            ->where('quantity_change', '<', 0)
            ->whereDate('created_at', $today)
            ->sum('quantity_change') * -1;
        $feedConsumption = InventoryLog::where('item_type', Feed::class)->where('quantity_change', '<', 0)->sum('quantity_change') * -1;
        $lowStockEggs = Eggs::whereColumn('current_stock', '<=', 'min_stock_level')->count();
        $lowStockFeeds = Feed::whereColumn('current_stock', '<=', 'min_stock_level')->count();
        $lowStockItems = Eggs::whereColumn('current_stock', '<=', 'min_stock_level')
            ->get()
            ->map(fn($item) => [
                'label' => "Eggs: {$item->egg_type}",
                'current_stock' => $item->current_stock,
                'min_stock_level' => $item->min_stock_level,
            ])
            ->merge(Feed::whereColumn('current_stock', '<=', 'min_stock_level')
                ->get()
                ->map(fn($item) => [
                    'label' => "Feed: {$item->name}",
                    'current_stock' => $item->current_stock,
                    'min_stock_level' => $item->min_stock_level,
                ]));
        $recentNotifications = Notification::orderBy('created_at', 'desc')->limit(5)->get();

        $salesTrend = $monthlySales->pluck('net_income')->map(fn($value) => round($value, 2))->toArray();
        $salesTrendLabels = $monthlySales->pluck('month')->toArray();

        return view('dashboard', compact(
            'totalDucks',
            'activeDucks',
            'totalEggProduction',
            'availableEggStock',
            'totalFeedStock',
            'dailyEggProduction',
            'dailyFeedConsumption',
            'dailySales',
            'monthlyIncome',
            'grossSales',
            'netIncome',
            'totalExpenses',
            'feedConsumption',
            'lowStockEggs',
            'lowStockFeeds',
            'lowStockItems',
            'recentNotifications',
            'salesTrend',
            'salesTrendLabels',
        ));
    }
}

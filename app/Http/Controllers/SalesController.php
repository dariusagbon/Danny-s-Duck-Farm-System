<?php

namespace App\Http\Controllers;

use App\Models\sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sales = sales::with('customer')
            ->when($search, fn($query) => $query->where('month_of', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('SalesView.create', compact('sales', 'search'));
    }

    public function create()
    {
        return $this->index();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'total_trays' => 'required|integer|min:0',
            'total_eggs_sold' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
            'total_expenses' => 'required|numeric|min:0',
            'month_of' => 'required|date',
            'customer_id' => 'nullable|exists:customers,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $data['gross_income'] = $data['total_eggs_sold'] * $data['selling_price'];
        $data['net_income'] = $data['gross_income'] - $data['total_expenses'];

        sales::create($data);

        return redirect()->route('sales.index')->with('success', 'Sales record created successfully.');
    }

    public function edit(sales $sale)
    {
        return view('SalesView.edit', compact('sale'));
    }

    public function update(Request $request, sales $sale)
    {
        $data = $request->validate([
            'total_trays' => 'required|integer|min:0',
            'total_eggs_sold' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
            'total_expenses' => 'required|numeric|min:0',
            'month_of' => 'required|date',
            'customer_id' => 'nullable|exists:customers,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $data['gross_income'] = $data['total_eggs_sold'] * $data['selling_price'];
        $data['net_income'] = $data['gross_income'] - $data['total_expenses'];

        $sale->update($data);

        return redirect()->route('sales.index')->with('success', 'Sales record updated successfully.');
    }

    public function destroy(sales $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sales record deleted successfully.');
    }
}

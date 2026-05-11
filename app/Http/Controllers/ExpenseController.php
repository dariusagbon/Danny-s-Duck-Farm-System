<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $expenses = Expense::with('user')
            ->when($search, fn($query) => $query->where('category', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('Expenses.index', compact('expenses', 'search'));
    }

    public function create()
    {
        return view('Expenses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $data['user_id'] = auth()->id();

        Expense::create($data);

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully.');
    }

    public function edit(Expense $expense)
    {
        return view('Expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $expense->update($data);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}

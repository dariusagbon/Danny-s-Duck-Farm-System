<?php

namespace App\Http\Controllers;

use App\Models\Eggs;
use Illuminate\Http\Request;

class EggsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $eggs = Eggs::when($search, fn($query) => $query->where('egg_type', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('EggsView.create', compact('eggs', 'search'));
    }

    public function create(Request $request)
    {
        return $this->index($request);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'egg_type' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'current_stock' => 'nullable|integer|min:0',
            'min_stock_level' => 'nullable|integer|min:0',
        ]);

        $data['current_stock'] = $data['current_stock'] ?? $data['quantity'];
        $data['min_stock_level'] = $data['min_stock_level'] ?? 10;

        Eggs::create($data);

        return redirect()->route('eggs.index')->with('success', 'Egg record created successfully.');
    }

    public function edit(Eggs $egg)
    {
        return view('EggsView.edit', compact('egg'));
    }

    public function update(Request $request, Eggs $egg)
    {
        $data = $request->validate([
            'egg_type' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
            'current_stock' => 'nullable|integer|min:0',
            'min_stock_level' => 'nullable|integer|min:0',
        ]);

        $egg->update($data);

        return redirect()->route('eggs.index')->with('success', 'Egg record updated successfully.');
    }

    public function destroy(Eggs $egg)
    {
        $egg->delete();

        return redirect()->route('eggs.index')->with('success', 'Egg record deleted successfully.');
    }
}

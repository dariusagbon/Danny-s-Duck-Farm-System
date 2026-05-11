<?php

namespace App\Http\Controllers;

use App\Models\feeds;
use Illuminate\Http\Request;

class FeedsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $feeds = feeds::when($search, fn($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('FeedsView.create', compact('feeds', 'search'));
    }

    public function create()
    {
        return $this->index();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'current_stock' => 'nullable|numeric|min:0',
            'min_stock_level' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:25',
        ]);

        $data['current_stock'] = $data['current_stock'] ?? 0;
        $data['min_stock_level'] = $data['min_stock_level'] ?? 5;
        $data['unit'] = $data['unit'] ?? 'kg';

        feeds::create($data);

        return redirect()->route('feeds.index')->with('success', 'Feed record created successfully.');
    }

    public function edit(feeds $feed)
    {
        return view('FeedsView.edit', compact('feed'));
    }

    public function update(Request $request, feeds $feed)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'current_stock' => 'nullable|numeric|min:0',
            'min_stock_level' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:25',
        ]);

        $feed->update($data);

        return redirect()->route('feeds.index')->with('success', 'Feed record updated successfully.');
    }

    public function destroy(feeds $feed)
    {
        $feed->delete();

        return redirect()->route('feeds.index')->with('success', 'Feed record deleted successfully.');
    }
}

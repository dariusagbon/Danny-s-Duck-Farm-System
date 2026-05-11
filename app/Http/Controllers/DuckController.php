<?php

namespace App\Http\Controllers;

use App\Models\Duck;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DuckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Duck::query();

        if ($search = request('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $ducks = $query->latest()->paginate(10);
        return view('ducks.index', compact('ducks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('ducks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'breed' => 'nullable|string|max:255',
            'hatch_date' => 'required|date|before_or_equal:today',
            'status' => 'required|in:active,sold,deceased',
        ]);

        Duck::create($request->all());

        return redirect()->route('ducks.index')->with('success', 'Duck added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Duck $duck): View
    {
        return view('ducks.show', compact('duck'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Duck $duck): View
    {
        return view('ducks.edit', compact('duck'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Duck $duck): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'breed' => 'nullable|string|max:255',
            'hatch_date' => 'required|date|before_or_equal:today',
            'status' => 'required|in:active,sold,deceased',
        ]);

        $duck->update($request->all());

        return redirect()->route('ducks.index')->with('success', 'Duck updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Duck $duck): RedirectResponse
    {
        $duck->delete();

        return redirect()->route('ducks.index')->with('success', 'Duck deleted successfully.');
    }
}

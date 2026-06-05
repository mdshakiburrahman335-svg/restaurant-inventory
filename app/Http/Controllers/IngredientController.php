<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::latest()->get();

        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
        ]);

        Ingredient::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'current_stock' => $request->current_stock,
            'minimum_stock' => $request->minimum_stock,
        ]);

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient added successfully.');
    }

    public function show(Ingredient $ingredient)
    {
        return redirect()->route('ingredients.index');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
        ]);

        $ingredient->update([
            'name' => $request->name,
            'unit' => $request->unit,
            'current_stock' => $request->current_stock,
            'minimum_stock' => $request->minimum_stock,
        ]);

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient deleted successfully.');
    }

    public function restockForm(Ingredient $ingredient)
    {
        return view('ingredients.restock', compact('ingredient'));
    }

    public function restock(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0.01',
            'reason' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $ingredient) {
            $ingredient->increment('current_stock', $request->quantity);

            StockMovement::create([
                'ingredient_id' => $ingredient->id,
                'type' => 'IN',
                'quantity' => $request->quantity,
                'reason' => $request->reason ?? 'Restock',
                'reference_id' => null,
            ]);
        });

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Stock added successfully.');
    }
}
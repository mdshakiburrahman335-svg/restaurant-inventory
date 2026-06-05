<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\MenuPortion;
use App\Models\PortionIngredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortionIngredientController extends Controller
{
    public function index()
    {
        $menuPortions = MenuPortion::with(['menuItem', 'portionIngredients.ingredient'])
            ->latest()
            ->get();

        return view('portion_ingredients.index', compact('menuPortions'));
    }

    public function create(Request $request)
    {
        $menuPortions = MenuPortion::with('menuItem')
            ->where('status', 1)
            ->get();

        $ingredients = Ingredient::orderBy('name')->get();

        $selectedPortion = null;
        $existingRecipe = [];

        if ($request->portion_id) {
            $selectedPortion = MenuPortion::with('menuItem')
                ->find($request->portion_id);

            $existingRecipe = PortionIngredient::where('menu_portion_id', $request->portion_id)
                ->pluck('quantity_required', 'ingredient_id')
                ->toArray();
        }

        return view('portion_ingredients.create', compact(
            'menuPortions',
            'ingredients',
            'selectedPortion',
            'existingRecipe'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_portion_id' => 'required|exists:menu_portions,id',
            'ingredients' => 'required|array',
            'ingredients.*' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            PortionIngredient::where('menu_portion_id', $request->menu_portion_id)->delete();

            foreach ($request->ingredients as $ingredientId => $quantity) {
                if ($quantity !== null && $quantity > 0) {
                    PortionIngredient::create([
                        'menu_portion_id' => $request->menu_portion_id,
                        'ingredient_id' => $ingredientId,
                        'quantity_required' => $quantity,
                    ]);
                }
            }
        });

        return redirect()
            ->route('portion-ingredients.index')
            ->with('success', 'Recipe saved successfully.');
    }

    public function edit(PortionIngredient $portionIngredient)
    {
        return redirect()->route('portion-ingredients.create', [
            'portion_id' => $portionIngredient->menu_portion_id
        ]);
    }

    public function update(Request $request, PortionIngredient $portionIngredient)
    {
        return $this->store($request);
    }

    public function destroy(PortionIngredient $portionIngredient)
    {
        $portionIngredient->delete();

        return redirect()
            ->route('portion-ingredients.index')
            ->with('success', 'Recipe ingredient deleted successfully.');
    }
}
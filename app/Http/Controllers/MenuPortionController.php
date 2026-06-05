<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuPortion;
use Illuminate\Http\Request;

class MenuPortionController extends Controller
{
    public function index()
    {
        $menuPortions = MenuPortion::with('menuItem')->latest()->get();

        return view('menu_portions.index', compact('menuPortions'));
    }

    public function create()
    {
        $menuItems = MenuItem::where('status', 1)->get();

        return view('menu_portions.create', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        MenuPortion::create([
            'menu_item_id' => $request->menu_item_id,
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('menu-portions.index')
            ->with('success', 'Menu portion added successfully.');
    }

    public function show(MenuPortion $menuPortion)
    {
        return redirect()->route('menu-portions.index');
    }

    public function edit(MenuPortion $menuPortion)
    {
        $menuItems = MenuItem::where('status', 1)->get();

        return view('menu_portions.edit', compact('menuPortion', 'menuItems'));
    }

    public function update(Request $request, MenuPortion $menuPortion)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $menuPortion->update([
            'menu_item_id' => $request->menu_item_id,
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('menu-portions.index')
            ->with('success', 'Menu portion updated successfully.');
    }

    public function destroy(MenuPortion $menuPortion)
    {
        $menuPortion->delete();

        return redirect()
            ->route('menu-portions.index')
            ->with('success', 'Menu portion deleted successfully.');
    }
}
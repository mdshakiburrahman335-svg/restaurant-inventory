<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::latest()->get();

        return view('menu_items.index', compact('menuItems'));
    }

    public function create()
    {
        return view('menu_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item added successfully.');
    }

    public function show(MenuItem $menuItem)
    {
        return redirect()->route('menu-items.index');
    }

    public function edit(MenuItem $menuItem)
    {
        return view('menu_items.edit', compact('menuItem'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $menuItem->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item deleted successfully.');
    }
}
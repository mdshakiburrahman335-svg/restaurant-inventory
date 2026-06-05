<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\MenuItem;
use App\Models\MenuPortion;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalIngredients = Ingredient::count();
        $totalMenuItems = MenuItem::count();
        $totalPortions = MenuPortion::count();
        $totalOrders = Order::count();

        $lowStockIngredients = Ingredient::whereColumn('current_stock', '<=', 'minimum_stock')
            ->get();

        $recentOrders = Order::with('orderItems.menuPortion.menuItem')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalIngredients',
            'totalMenuItems',
            'totalPortions',
            'totalOrders',
            'lowStockIngredients',
            'recentOrders'
        ));
    }
}
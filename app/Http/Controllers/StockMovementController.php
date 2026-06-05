<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;

class StockMovementController extends Controller
{
    public function index()
    {
        $stockMovements = StockMovement::with('ingredient')
            ->latest()
            ->get();

        return view('stock_movements.index', compact('stockMovements'));
    }
}
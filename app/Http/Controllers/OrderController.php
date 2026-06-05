<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\MenuPortion;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.menuPortion.menuItem')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $menuPortions = MenuPortion::with(['menuItem', 'portionIngredients.ingredient'])
            ->where('status', 1)
            ->get();

        return view('orders.create', compact('menuPortions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'menu_portion_id' => 'required|exists:menu_portions,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menuPortion = MenuPortion::with(['menuItem', 'portionIngredients.ingredient'])
            ->findOrFail($request->menu_portion_id);

        if ($menuPortion->portionIngredients->count() == 0) {
            return back()
                ->withInput()
                ->with('error', 'Recipe is not set for this portion.');
        }

        $orderQuantity = $request->quantity;

        foreach ($menuPortion->portionIngredients as $recipe) {
            $requiredQty = $recipe->quantity_required * $orderQuantity;
            $ingredient = $recipe->ingredient;

            if ($ingredient->current_stock < $requiredQty) {
                return back()
                    ->withInput()
                    ->with('error', $ingredient->name . ' stock is not enough. Required: ' . $requiredQty . ' ' . $ingredient->unit . ', Available: ' . $ingredient->current_stock . ' ' . $ingredient->unit);
            }
        }

        DB::transaction(function () use ($request, $menuPortion, $orderQuantity) {
            $subtotal = $menuPortion->price * $orderQuantity;

            $order = Order::create([
                'order_no' => 'ORD-' . time(),
                'customer_name' => $request->customer_name,
                'total_amount' => $subtotal,
                'status' => 'confirmed',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $menuPortion->menu_item_id,
                'menu_portion_id' => $menuPortion->id,
                'quantity' => $orderQuantity,
                'price' => $menuPortion->price,
                'subtotal' => $subtotal,
            ]);

            foreach ($menuPortion->portionIngredients as $recipe) {
                $requiredQty = $recipe->quantity_required * $orderQuantity;
                $ingredient = $recipe->ingredient;

                $ingredient->decrement('current_stock', $requiredQty);

                StockMovement::create([
                    'ingredient_id' => $ingredient->id,
                    'type' => 'OUT',
                    'quantity' => $requiredQty,
                    'reason' => 'Order ' . $order->order_no,
                    'reference_id' => $order->id,
                ]);
            }
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order placed successfully and stock deducted.');
    }

    public function show(Order $order)
    {
        $order->load('orderItems.menuItem', 'orderItems.menuPortion');

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return redirect()->route('orders.index');
    }

    public function update(Request $request, Order $order)
    {
        return redirect()->route('orders.index');
    }

    public function destroy(Order $order)
    {
        return back()->with('error', 'Order delete is disabled because stock has already been deducted.');
    }
}
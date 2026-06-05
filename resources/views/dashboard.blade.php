@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Restaurant Inventory Dashboard')

@section('content')

<div class="cards">
    <div class="stat-card">
        <h3>Total Ingredients</h3>
        <p>{{ $totalIngredients }}</p>
    </div>

    <div class="stat-card">
        <h3>Total Menu Items</h3>
        <p>{{ $totalMenuItems }}</p>
    </div>

    <div class="stat-card">
        <h3>Total Portions</h3>
        <p>{{ $totalPortions }}</p>
    </div>

    <div class="stat-card">
        <h3>Total Orders</h3>
        <p>{{ $totalOrders }}</p>
    </div>
</div>

<div class="content-card">
    <h3>Low Stock Ingredients</h3>

    <table>
        <thead>
            <tr>
                <th>Ingredient</th>
                <th>Current Stock</th>
                <th>Minimum Stock</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($lowStockIngredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->current_stock }} {{ $ingredient->unit }}</td>
                    <td>{{ $ingredient->minimum_stock }} {{ $ingredient->unit }}</td>
                    <td><span class="badge-danger">Low Stock</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <span class="badge-success">All ingredients are available.</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<br>

<div class="content-card">
    <h3>Recent Orders</h3>

    <table>
        <thead>
            <tr>
                <th>Order No</th>
                <th>Customer</th>
                <th>Item</th>
                <th>Total Amount</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($recentOrders as $order)
                <tr>
                    <td>{{ $order->order_no }}</td>
                    <td>{{ $order->customer_name ?? 'N/A' }}</td>
                    <td>
                        @foreach($order->orderItems as $item)
                            {{ $item->menuPortion->menuItem->name ?? 'N/A' }}
                            -
                            {{ $item->menuPortion->name ?? 'N/A' }}
                        @endforeach
                    </td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No recent orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

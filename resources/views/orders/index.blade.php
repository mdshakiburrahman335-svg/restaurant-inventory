@extends('layouts.app')

@section('title', 'Orders')
@section('page-title', 'Order List')

@section('content')

<div class="content-card">
    <div class="top-actions">
        <a href="{{ route('orders.create') }}" class="btn">Create Order</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Order No</th>
                <th>Customer</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_no }}</td>
                    <td>{{ $order->customer_name ?? 'N/A' }}</td>
                    <td>
                        @foreach($order->orderItems as $item)
                            {{ $item->menuPortion->menuItem->name ?? 'N/A' }}
                            -
                            {{ $item->menuPortion->name ?? 'N/A' }}
                        @endforeach
                    </td>
                    <td>
                        @foreach($order->orderItems as $item)
                            {{ $item->quantity }}
                        @endforeach
                    </td>
                    <td>{{ $order->total_amount }}</td>
                    <td>
                        <span class="badge-success">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
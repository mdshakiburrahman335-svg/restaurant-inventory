@extends('layouts.app')

@section('title', 'Order Details')
@section('page-title', 'Order Details')

@section('content')

<div class="content-card">
    <div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:20px;">
        <p><b>Order No:</b> {{ $order->order_no }}</p>
        <p><b>Customer:</b> {{ $order->customer_name ?? 'N/A' }}</p>
        <p><b>Total Amount:</b> {{ $order->total_amount }}</p>
        <p><b>Status:</b> <span class="badge-success">{{ ucfirst($order->status) }}</span></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Food Item</th>
                <th>Portion</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->menuItem->name ?? 'N/A' }}</td>
                    <td>{{ $item->menuPortion->name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <a href="{{ route('orders.index') }}" class="btn">Back</a>
</div>

@endsection
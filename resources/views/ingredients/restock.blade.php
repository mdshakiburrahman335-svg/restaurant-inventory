@extends('layouts.app')

@section('title', 'Restock Ingredient')
@section('page-title', 'Restock Ingredient')

@section('content')

<div class="content-card">
    <div style="background:#f8fafc; padding:15px; border-radius:8px; margin-bottom:18px; border:1px solid #e5e7eb;">
        <p><b>Ingredient:</b> {{ $ingredient->name }}</p>
        <p><b>Current Stock:</b> {{ $ingredient->current_stock }} {{ $ingredient->unit }}</p>
        <p><b>Minimum Stock:</b> {{ $ingredient->minimum_stock }} {{ $ingredient->unit }}</p>
    </div>

    <form action="{{ route('ingredients.restock', $ingredient->id) }}" method="POST">
        @csrf

        <label>Restock Quantity</label>
        <input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}" placeholder="Example: 5000">
        @error('quantity')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Reason</label>
        <input type="text" name="reason" value="{{ old('reason') }}" placeholder="Example: Purchase from supplier">
        @error('reason')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-purple">Add Stock</button>
        <a href="{{ route('ingredients.index') }}" class="back">Back</a>
    </form>
</div>

@endsection
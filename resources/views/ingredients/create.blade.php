@extends('layouts.app')

@section('title', 'Add Ingredient')
@section('page-title', 'Add Ingredient')

@section('content')

<div class="content-card">
    <form action="{{ route('ingredients.store') }}" method="POST">
        @csrf

        <label>Ingredient Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Rice">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Unit</label>
        <select name="unit">
            <option value="">Select Unit</option>
            <option value="gram" {{ old('unit') == 'gram' ? 'selected' : '' }}>Gram</option>
            <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>KG</option>
            <option value="ml" {{ old('unit') == 'ml' ? 'selected' : '' }}>ML</option>
            <option value="liter" {{ old('unit') == 'liter' ? 'selected' : '' }}>Liter</option>
            <option value="piece" {{ old('unit') == 'piece' ? 'selected' : '' }}>Piece</option>
        </select>
        @error('unit')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Current Stock</label>
        <input type="number" step="0.01" name="current_stock" value="{{ old('current_stock') }}" placeholder="Example: 10000">
        @error('current_stock')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Minimum Stock</label>
        <input type="number" step="0.01" name="minimum_stock" value="{{ old('minimum_stock') }}" placeholder="Example: 2000">
        @error('minimum_stock')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">Save Ingredient</button>
        <a href="{{ route('ingredients.index') }}" class="back">Back</a>
    </form>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Edit Ingredient')
@section('page-title', 'Edit Ingredient')

@section('content')

<div class="content-card">
    <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Ingredient Name</label>
        <input type="text" name="name" value="{{ old('name', $ingredient->name) }}">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Unit</label>
        <select name="unit">
            <option value="">Select Unit</option>
            <option value="gram" {{ old('unit', $ingredient->unit) == 'gram' ? 'selected' : '' }}>Gram</option>
            <option value="kg" {{ old('unit', $ingredient->unit) == 'kg' ? 'selected' : '' }}>KG</option>
            <option value="ml" {{ old('unit', $ingredient->unit) == 'ml' ? 'selected' : '' }}>ML</option>
            <option value="liter" {{ old('unit', $ingredient->unit) == 'liter' ? 'selected' : '' }}>Liter</option>
            <option value="piece" {{ old('unit', $ingredient->unit) == 'piece' ? 'selected' : '' }}>Piece</option>
        </select>
        @error('unit')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Current Stock</label>
        <input type="number" step="0.01" name="current_stock" value="{{ old('current_stock', $ingredient->current_stock) }}">
        @error('current_stock')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Minimum Stock</label>
        <input type="number" step="0.01" name="minimum_stock" value="{{ old('minimum_stock', $ingredient->minimum_stock) }}">
        @error('minimum_stock')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-green">Update Ingredient</button>
        <a href="{{ route('ingredients.index') }}" class="back">Back</a>
    </form>
</div>

@endsection
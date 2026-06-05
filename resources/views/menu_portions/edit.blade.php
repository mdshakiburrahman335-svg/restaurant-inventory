@extends('layouts.app')

@section('title', 'Edit Menu Portion')
@section('page-title', 'Edit Menu Portion')

@section('content')

<div class="content-card">
    <form action="{{ route('menu-portions.update', $menuPortion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Food Item</label>
        <select name="menu_item_id">
            <option value="">Select Food Item</option>
            @foreach($menuItems as $menuItem)
                <option value="{{ $menuItem->id }}"
                    {{ old('menu_item_id', $menuPortion->menu_item_id) == $menuItem->id ? 'selected' : '' }}>
                    {{ $menuItem->name }}
                </option>
            @endforeach
        </select>
        @error('menu_item_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Portion Name</label>
        <input type="text" name="name" value="{{ old('name', $menuPortion->name) }}">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $menuPortion->price) }}">
        @error('price')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Status</label>
        <select name="status">
            <option value="1" {{ old('status', $menuPortion->status) == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $menuPortion->status) == '0' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-green">Update Portion</button>
        <a href="{{ route('menu-portions.index') }}" class="back">Back</a>
    </form>
</div>

@endsection
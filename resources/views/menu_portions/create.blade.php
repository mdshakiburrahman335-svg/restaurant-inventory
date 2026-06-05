@extends('layouts.app')

@section('title', 'Add Menu Portion')
@section('page-title', 'Add Menu Portion')

@section('content')

<div class="content-card">
    <form action="{{ route('menu-portions.store') }}" method="POST">
        @csrf

        <label>Food Item</label>
        <select name="menu_item_id">
            <option value="">Select Food Item</option>
            @foreach($menuItems as $menuItem)
                <option value="{{ $menuItem->id }}" {{ old('menu_item_id') == $menuItem->id ? 'selected' : '' }}>
                    {{ $menuItem->name }}
                </option>
            @endforeach
        </select>
        @error('menu_item_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Portion Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Half or Full">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="Example: 120">
        @error('price')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Status</label>
        <select name="status">
            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">Save Portion</button>
        <a href="{{ route('menu-portions.index') }}" class="back">Back</a>
    </form>
</div>

@endsection
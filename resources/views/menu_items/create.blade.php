@extends('layouts.app')

@section('title', 'Add Menu Item')
@section('page-title', 'Add Menu Item')

@section('content')

<div class="content-card">
    <form action="{{ route('menu-items.store') }}" method="POST">
        @csrf

        <label>Food Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Biryani">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Description</label>
        <textarea name="description" placeholder="Example: Chicken biryani with special spices">{{ old('description') }}</textarea>
        @error('description')
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

        <button type="submit" class="btn">Save Menu Item</button>
        <a href="{{ route('menu-items.index') }}" class="back">Back</a>
    </form>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Edit Menu Item')
@section('page-title', 'Edit Menu Item')

@section('content')

<div class="content-card">
    <form action="{{ route('menu-items.update', $menuItem->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Food Name</label>
        <input type="text" name="name" value="{{ old('name', $menuItem->name) }}">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Description</label>
        <textarea name="description">{{ old('description', $menuItem->description) }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Status</label>
        <select name="status">
            <option value="1" {{ old('status', $menuItem->status) == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $menuItem->status) == '0' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-green">Update Menu Item</button>
        <a href="{{ route('menu-items.index') }}" class="back">Back</a>
    </form>
</div>

@endsection
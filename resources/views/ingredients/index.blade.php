@extends('layouts.app')

@section('title', 'Ingredients')
@section('page-title', 'Ingredient List')

@section('content')

<div class="content-card">
    <div class="top-actions">
        <a href="{{ route('ingredients.create') }}" class="btn">Add Ingredient</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Current Stock</th>
                <th>Minimum Stock</th>
                <th>Status</th>
                <th width="260">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($ingredients as $ingredient)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->unit }}</td>
                    <td>{{ $ingredient->current_stock }}</td>
                    <td>{{ $ingredient->minimum_stock }}</td>
                    <td>
                        @if($ingredient->current_stock <= $ingredient->minimum_stock)
                            <span class="badge-danger">Low Stock</span>
                        @else
                            <span class="badge-success">Available</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('ingredients.restock.form', $ingredient->id) }}" class="btn btn-purple">
                            Restock
                        </a>

                        <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-green">
                            Edit
                        </a>

                        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-red" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No ingredients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
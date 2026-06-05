@extends('layouts.app')

@section('title', 'Menu Items')
@section('page-title', 'Menu Item List')

@section('content')

<div class="content-card">
    <div class="top-actions">
        <a href="{{ route('menu-items.create') }}" class="btn">Add Menu Item</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($menuItems as $menuItem)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $menuItem->name }}</td>
                    <td>{{ $menuItem->description ?? 'N/A' }}</td>
                    <td>
                        @if($menuItem->status)
                            <span class="badge-success">Active</span>
                        @else
                            <span class="badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('menu-items.edit', $menuItem->id) }}" class="btn btn-green">
                            Edit
                        </a>

                        <form action="{{ route('menu-items.destroy', $menuItem->id) }}" method="POST" class="inline">
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
                    <td colspan="5">No menu items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
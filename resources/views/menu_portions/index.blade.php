@extends('layouts.app')

@section('title', 'Menu Portions')
@section('page-title', 'Menu Portion List')

@section('content')

<div class="content-card">
    <div class="top-actions">
        <a href="{{ route('menu-portions.create') }}" class="btn">Add Portion</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Food Item</th>
                <th>Portion Name</th>
                <th>Price</th>
                <th>Status</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($menuPortions as $menuPortion)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $menuPortion->menuItem->name ?? 'N/A' }}</td>
                    <td>{{ $menuPortion->name }}</td>
                    <td>{{ $menuPortion->price }}</td>
                    <td>
                        @if($menuPortion->status)
                            <span class="badge-success">Active</span>
                        @else
                            <span class="badge-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('menu-portions.edit', $menuPortion->id) }}" class="btn btn-green">
                            Edit
                        </a>

                        <form action="{{ route('menu-portions.destroy', $menuPortion->id) }}" method="POST" class="inline">
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
                    <td colspan="6">No menu portions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
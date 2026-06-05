@extends('layouts.app')

@section('title', 'Stock Movement Report')
@section('page-title', 'Stock Movement Report')

@section('content')

<div class="content-card">
    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Ingredient</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Reason</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($stockMovements as $movement)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $movement->ingredient->name ?? 'N/A' }}</td>
                    <td>
                        @if($movement->type == 'OUT')
                            <span class="badge-danger">OUT</span>
                        @else
                            <span class="badge-success">IN</span>
                        @endif
                    </td>
                    <td>{{ $movement->quantity }}</td>
                    <td>{{ $movement->ingredient->unit ?? '' }}</td>
                    <td>{{ $movement->reason ?? 'N/A' }}</td>
                    <td>{{ $movement->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No stock movement found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
@extends('layouts.app')

@section('title', 'Recipe List')
@section('page-title', 'Recipe List')

@section('style')
<style>
    .recipe-card {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 18px;
        padding: 18px;
        background: #ffffff;
    }

    .recipe-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8fafc;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 12px;
    }

    .recipe-title {
        font-weight: bold;
        font-size: 18px;
    }

    .ingredient-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .ingredient-item {
        background: #f1f5f9;
        padding: 10px;
        border-radius: 5px;
    }

    .empty-recipe {
        color: #991b1b;
        background: #fee2e2;
        padding: 10px;
        border-radius: 5px;
    }
</style>
@endsection

@section('content')

<div class="content-card">
    <div class="top-actions">
        <a href="{{ route('portion-ingredients.create') }}" class="btn">Setup Recipe</a>
    </div>

    @forelse($menuPortions as $menuPortion)
        <div class="recipe-card">
            <div class="recipe-header">
                <div class="recipe-title">
                    {{ $menuPortion->menuItem->name ?? 'N/A' }} - {{ $menuPortion->name }}
                </div>

                <a href="{{ route('portion-ingredients.create', ['portion_id' => $menuPortion->id]) }}" class="btn btn-green">
                    Edit Recipe
                </a>
            </div>

            @if($menuPortion->portionIngredients->count() > 0)
                <div class="ingredient-list">
                    @foreach($menuPortion->portionIngredients as $recipe)
                        <div class="ingredient-item">
                            <b>{{ $recipe->ingredient->name ?? 'N/A' }}</b>
                            <br>
                            {{ $recipe->quantity_required }}
                            {{ $recipe->ingredient->unit ?? '' }}
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-recipe">
                    No recipe set for this portion yet.
                </div>
            @endif
        </div>
    @empty
        <p>No menu portions found.</p>
    @endforelse
</div>

@endsection
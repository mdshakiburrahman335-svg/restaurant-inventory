@extends('layouts.app')

@section('title', 'Recipe Setup')
@section('page-title', 'Recipe Setup')

@section('style')
<style>
    .help {
        background: #f8fafc;
        padding: 12px;
        border-left: 4px solid #2563eb;
        margin-bottom: 20px;
        color: #334155;
    }

    .recipe-box {
        margin-top: 25px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 20px;
        background: #ffffff;
    }

    .recipe-title {
        margin-bottom: 15px;
        padding: 10px;
        background: #eff6ff;
        color: #1e40af;
        border-radius: 5px;
        font-weight: bold;
    }

    .ingredient-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 15px;
        align-items: center;
        margin-bottom: 12px;
    }

    .ingredient-name {
        font-weight: bold;
        color: #111827;
    }

    .unit {
        color: #64748b;
    }

    .top-form {
        display: flex;
        gap: 10px;
        align-items: end;
    }

    .top-form div {
        flex: 1;
    }

    .top-form button {
        margin-bottom: 15px;
    }
</style>
@endsection

@section('content')

<div class="content-card">
    <div class="help">
        আগে Food Portion select করো। যেমন: <b>Biryani - Half</b>।
        তারপর নিচে Rice, Chicken, Oil, Spice এগুলোর quantity একসাথে set করো।
    </div>

    <form action="{{ route('portion-ingredients.create') }}" method="GET" class="top-form">
        <div>
            <label>Select Food Portion</label>
            <select name="portion_id" required>
                <option value="">Select Food Portion</option>
                @foreach($menuPortions as $menuPortion)
                    <option value="{{ $menuPortion->id }}"
                        {{ request('portion_id') == $menuPortion->id ? 'selected' : '' }}>
                        {{ $menuPortion->menuItem->name ?? 'N/A' }} - {{ $menuPortion->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">Load Recipe</button>
    </form>

    @if($selectedPortion)
        <div class="recipe-box">
            <div class="recipe-title">
                Recipe For:
                {{ $selectedPortion->menuItem->name ?? 'N/A' }}
                -
                {{ $selectedPortion->name }}
            </div>

            <form action="{{ route('portion-ingredients.store') }}" method="POST">
                @csrf

                <input type="hidden" name="menu_portion_id" value="{{ $selectedPortion->id }}">

                @foreach($ingredients as $ingredient)
                    <div class="ingredient-row">
                        <div class="ingredient-name">
                            {{ $ingredient->name }}
                        </div>

                        <div>
                            <input
                                type="number"
                                step="0.01"
                                name="ingredients[{{ $ingredient->id }}]"
                                value="{{ old('ingredients.' . $ingredient->id, $existingRecipe[$ingredient->id] ?? '') }}"
                                placeholder="Quantity">
                        </div>

                        <div class="unit">
                            {{ $ingredient->unit }}
                        </div>
                    </div>
                @endforeach

                @error('menu_portion_id')
                    <div class="error">{{ $message }}</div>
                @enderror

                @error('ingredients')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-green">
                    Save Fixed Recipe
                </button>

                <a href="{{ route('portion-ingredients.index') }}" class="back">Back</a>
            </form>
        </div>
    @endif
</div>

@endsection
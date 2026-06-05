<!DOCTYPE html>
<html>
<head>
    <title>Edit Recipe Ingredient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
        }

        .container {
            width: 650px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
        }

        .btn {
            padding: 10px 16px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back {
            display: inline-block;
            margin-left: 10px;
            color: #2563eb;
            text-decoration: none;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .alert-error {
            padding: 10px;
            background: #fee2e2;
            color: #991b1b;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Recipe Ingredient</h2>

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('portion-ingredients.update', $portionIngredient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Food Portion</label>
        <select name="menu_portion_id">
            <option value="">Select Food Portion</option>
            @foreach($menuPortions as $menuPortion)
                <option value="{{ $menuPortion->id }}"
                    {{ old('menu_portion_id', $portionIngredient->menu_portion_id) == $menuPortion->id ? 'selected' : '' }}>
                    {{ $menuPortion->menuItem->name ?? 'N/A' }} - {{ $menuPortion->name }}
                </option>
            @endforeach
        </select>
        @error('menu_portion_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Ingredient</label>
        <select name="ingredient_id">
            <option value="">Select Ingredient</option>
            @foreach($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}"
                    {{ old('ingredient_id', $portionIngredient->ingredient_id) == $ingredient->id ? 'selected' : '' }}>
                    {{ $ingredient->name }} ({{ $ingredient->unit }})
                </option>
            @endforeach
        </select>
        @error('ingredient_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Quantity Required</label>
        <input type="number" step="0.01" name="quantity_required" value="{{ old('quantity_required', $portionIngredient->quantity_required) }}">
        @error('quantity_required')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">Update Recipe Ingredient</button>
        <a href="{{ route('portion-ingredients.index') }}" class="back">Back</a>
    </form>
</div>

</body>
</html>
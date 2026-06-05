@extends('layouts.app')

@section('title', 'Create Order')
@section('page-title', 'Create Order')

@section('style')
<style>
    .recipe-box {
        margin-top: 20px;
        background: #f8fafc;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .ingredient-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 10px;
        margin-bottom: 10px;
        align-items: center;
    }

    .ingredient-row input {
        margin: 0;
        background: #e5e7eb;
    }

    .total-box {
        margin-top: 15px;
        padding: 12px;
        background: #eff6ff;
        color: #1e40af;
        border-radius: 5px;
        font-weight: bold;
    }
</style>
@endsection

@section('content')

<div class="content-card">
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <label>Customer Name</label>
        <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Optional">

        <label>Select Food Portion</label>
        <select name="menu_portion_id" id="menu_portion_id" required>
            <option value="">Select Food Portion</option>

            @foreach($menuPortions as $menuPortion)
                @php
                    $recipeData = [];

                    foreach ($menuPortion->portionIngredients as $recipe) {
                        $recipeData[] = [
                            'name' => $recipe->ingredient->name ?? 'N/A',
                            'unit' => $recipe->ingredient->unit ?? '',
                            'quantity' => $recipe->quantity_required,
                            'stock' => $recipe->ingredient->current_stock ?? 0,
                        ];
                    }
                @endphp

                <option
                    value="{{ $menuPortion->id }}"
                    data-price="{{ $menuPortion->price }}"
                    data-recipe='@json($recipeData)'>
                    {{ $menuPortion->menuItem->name ?? 'N/A' }} - {{ $menuPortion->name }} - {{ $menuPortion->price }}
                </option>
            @endforeach
        </select>

        @error('menu_portion_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Order Quantity</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" required>

        @error('quantity')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="recipe-box" id="recipeBox" style="display:none;">
            <h3>Fixed Recipe Preview</h3>

            <div class="ingredient-row">
                <b>Ingredient</b>
                <b>Per Portion</b>
                <b>Total Needed</b>
                <b>Available Stock</b>
            </div>

            <div id="recipeList"></div>

            <div class="total-box" id="totalAmount"></div>
        </div>

        <br>

        <button type="submit" class="btn">Confirm Order</button>
        <a href="{{ route('orders.index') }}" class="back">Back</a>
    </form>
</div>

<script>
    const portionSelect = document.getElementById('menu_portion_id');
    const quantityInput = document.getElementById('quantity');
    const recipeBox = document.getElementById('recipeBox');
    const recipeList = document.getElementById('recipeList');
    const totalAmount = document.getElementById('totalAmount');

    function updateRecipePreview() {
        const selectedOption = portionSelect.options[portionSelect.selectedIndex];

        if (!selectedOption.value) {
            recipeBox.style.display = 'none';
            recipeList.innerHTML = '';
            totalAmount.innerHTML = '';
            return;
        }

        const recipe = JSON.parse(selectedOption.dataset.recipe || '[]');
        const price = parseFloat(selectedOption.dataset.price || 0);
        const orderQty = parseInt(quantityInput.value || 1);

        recipeBox.style.display = 'block';
        recipeList.innerHTML = '';

        if (recipe.length === 0) {
            recipeList.innerHTML = '<p style="color:red;">No recipe set for this portion.</p>';
        }

        recipe.forEach(item => {
            const totalNeeded = item.quantity * orderQty;

            recipeList.innerHTML += `
                <div class="ingredient-row">
                    <div><b>${item.name}</b></div>
                    <input type="text" value="${item.quantity} ${item.unit}" disabled>
                    <input type="text" value="${totalNeeded} ${item.unit}" disabled>
                    <input type="text" value="${item.stock} ${item.unit}" disabled>
                </div>
            `;
        });

        totalAmount.innerHTML = 'Total Amount: ' + (price * orderQty).toFixed(2);
    }

    portionSelect.addEventListener('change', updateRecipePreview);
    quantityInput.addEventListener('input', updateRecipePreview);

    updateRecipePreview();
</script>

@endsection
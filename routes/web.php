<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\MenuPortionController;
use App\Http\Controllers\PortionIngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockMovementController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::post('/custom-logout', function (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    })->name('custom.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    
    Route::middleware(['role:admin,manager'])->group(function () {

        Route::get('ingredients/{ingredient}/restock', [IngredientController::class, 'restockForm'])
            ->name('ingredients.restock.form');

        Route::post('ingredients/{ingredient}/restock', [IngredientController::class, 'restock'])
            ->name('ingredients.restock');

        Route::resource('ingredients', IngredientController::class);

        Route::resource('menu-items', MenuItemController::class);
        Route::resource('menu-portions', MenuPortionController::class);
        Route::resource('portion-ingredients', PortionIngredientController::class);

        Route::get('stock-movements', [StockMovementController::class, 'index'])
            ->name('stock-movements.index');
    });

   
    Route::middleware(['role:admin,manager,staff'])->group(function () {
        Route::resource('orders', OrderController::class);
    });
});

require __DIR__.'/auth.php';
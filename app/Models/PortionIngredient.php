<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortionIngredient extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_portion_id',
        'ingredient_id',
        'quantity_required',
    ];

    public function menuPortion()
    {
        return $this->belongsTo(MenuPortion::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}

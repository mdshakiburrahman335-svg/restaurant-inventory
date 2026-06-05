<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPortion extends Model
{
    protected $fillable = [
        'menu_item_id',
        'name',
        'price',
        'status',
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function portionIngredients()
    {
        return $this->hasMany(PortionIngredient::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'portion_ingredients')
                    ->withPivot('quantity_required')
                    ->withTimestamps();
    }
}
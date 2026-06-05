<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'current_stock',
        'minimum_stock',
    ];

    public function portions()
    {
        return $this->belongsToMany(MenuPortion::class, 'portion_ingredients')
                    ->withPivot('quantity_required')
                    ->withTimestamps();
    }
}
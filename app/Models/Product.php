<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        "image",
        "name",
        "description",
        "price",
        "stock",
        "brand"
    ];

    public function lines(): HasMany
    {
        return $this->hasMany(Line::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_products')
                    ->withPivot(['units', 'date'])
                    ->withTimestamps();
    }
}

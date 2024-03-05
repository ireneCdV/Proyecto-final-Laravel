<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

                //Esto seria igual que la clase de User.php
                protected $fillable = [
                    "image",
                    "name",
                    "description",
                    "price",
                    "stock",
                    "brand"
                ];
    
                public function lines():HasMany{
                    return $this->hasMany(Line::class);
                }
}

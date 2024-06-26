<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Line extends Model
{
    use HasFactory;

    
    protected $fillable = [
        "amount"
    ];


    public function invoice():BelongsTo{
        return $this->belongsTo(Invoice::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

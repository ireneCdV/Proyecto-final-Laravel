<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;


    protected $fillable = [
        "num_invoice",
        "date",
        "total",
        "user_id" // clave foránea que referencia al usuario que solicita la factura

    ];

    protected $casts = [
        "date" => "datetime"
    ];

    public function cliente():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function line() {
        return $this->hasMany(Line::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variant',
        'quantity',
        'type',
        'date',
    ];

    public function product_variant(){
        return $this->belongsTo(ProductVariant::class);
    }
}

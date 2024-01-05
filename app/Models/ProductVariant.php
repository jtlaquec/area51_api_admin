<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'sku',
        'name',
        'price',
        'discount_price',
        'percentage_discount',
        'stock',
        'slug',
        'is_active',
        'has_discount',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function images(){
        return $this->hasmany(Image::class);
    }

    public function order_details(){
        return $this->hasmany(OrderDetail::class);
    }

    public function inventories(){
        return $this->hasmany(Inventory::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'district_id',
        'cost',
        'estimated_delivery_date',
        'shipping_method_id',
        'shipping_number',
        'shipping_code',
        'notes',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function shipping_method(){
        return $this->belongsTo(ShippingMethod::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
}

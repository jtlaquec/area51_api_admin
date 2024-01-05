<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'datetime',
        'total',
        'reason',
        'state_id',
        'user_id',

    ];

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order_details(){
        return $this->hasmany(OrderDetail::class);
    }

    public function payment_detail(){
        return $this->hasmany(PaymentDetail::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class);
    }



    public function receipt(){
        return $this->belongsTo(Receipt::class);
    }
}

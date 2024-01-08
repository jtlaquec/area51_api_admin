<?php

namespace App\Models;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'datetime',
        'number',
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
        return $this->hasmany(Shipping::class);
    }

    public function receipt(){
        return $this->belongsTo(Receipt::class);
    }
}

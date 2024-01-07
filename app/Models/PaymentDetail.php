<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'order_id',
        'image_path',
        'date',
        'notes',
        'pay',
        'payment_state_id',
    ];

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function payment_state(){
        return $this->belongsTo(PaymentState::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}

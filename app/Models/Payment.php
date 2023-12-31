<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_logo',
        'image_qr',
        'payment_method_id',
    ];

    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function payment_details(){
        return $this->hasmany(PaymentDetail::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'serie_id',
    ];


    public function serie(){
        return $this->belongsTo(Serie::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }


}

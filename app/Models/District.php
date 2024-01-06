<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id',
        'department_id',
    ];

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function users(){
        return $this->hasmany(User::class);
    }

    public function shippings(){
        return $this->hasmany(Shipping::class);
    }


}

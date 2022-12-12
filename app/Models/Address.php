<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'user_id',
        'city',
        'building',
        'emirate',
        'name'
    ];

public function order(){
    return $this->belongsToMany(Order::class);
}
}

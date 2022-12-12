<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'uuid',
        'address_id',
        'payment_id',
        'customer_name',
        'customer_phone',
        'lat',
        'long',
        'total_price',
        'guest_address',
        'notes',
        'status',

    ];

    public function items(){
        return $this->hasMany(Item::class);
    }


}

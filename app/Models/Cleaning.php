<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cleaning extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'price',
        'category_id',

    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable = [
        'text_en',
        'text_ar',
        'img',
        'mode',
        'wa_phone',
        'about_us_en',
        'about_us_ar',
        'deliver_policy_en',
        'deliver_policy_ar',
        'return_policy_en',
        'return_policy_ar',
    ];

}

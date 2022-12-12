<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $fillable = ['scale','comment','product_id','user_id'];
    protected $appends =['user_name'];

    public function getUserNameAttribute(){

        $user = User::find($this->user_id);
        return $user->name;
    }


    public function product(){
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'price',
        'have_discount',
        'discounted_price',
        'img',
        'category_id',
        'sales',
        'isfish'
    ];

    protected $appends =['is_favorite','can_rate','rates_count'];

    public function rates(){
        return $this->hasMany(Rate::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function getIsFavoriteAttribute(){
        if(auth('sanctum')->user()){
            $fav = Favorite::where('product_id',$this->id)->where('user_id',auth('sanctum')->user()->id)->first();
            if($fav){
                return 1;
            }else{
                return 0;
            }
        }
    }
    public function getCanRateAttribute(){
        if(auth('sanctum')->user()){
            $user_id =auth('sanctum')->user()->id;


            if($this->order_id){

                $order = Order::findOrFail($this->order_id);
                if($order){
                    if($order->user_id == $user_id){
                        return true;
                    }
                }else{
                    return false;
                }

            }else{
                return false;
            }
        }
    }

    public function getRatesCountAttribute(){

        $r = Rate::where('product_id',$this->id)->get();
        return count($r);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;

use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    //
    public function store(Request $request)
    {

        $user_id = $request->user()->id;

        $check = Rate::where('product_id',$request->product_id)
        ->where('user_id',$user_id)->first();

        if($check){
            return response(trans('api.ratecheck'),422);
        }

        $request->validate([

            'product_id'=> 'required|exists:products,id',
            'scale' => 'numeric|in:1,,2,3,4,5',
            'comment' => 'max:500',

        ]);




        $rate = Rate::create([
            'product_id' => $request->product_id,
            'user_id' => $user_id,
            'scale' => $request->scale,
            'comment' => $request->comment,
        ]);
        $response = [
            'message' => trans('api.ratestored'),
            'data' => $rate,

        ];

        return response($response,201);
        //
    }

    public function ProductRates($product_id){

        $rates = Rate::where('product_id',$product_id)->get();

        $response = [
            'message' => trans('api.fetch'),
            'data' => $rates,

        ];

        return response($response,201);

    }
}

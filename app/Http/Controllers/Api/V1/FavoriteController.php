<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function add(Request $request){

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $fav = Favorite::where('user_id',$request->user()->id)->where('product_id',$request->product_id)->first();

        if($fav){
            $response = [
                'message' => trans('api.notallowed'),

            ];

            return response($response,422);
        }else{
            $fav = Favorite::create([
                'product_id' => $request->product_id,
                'user_id' => $request->user()->id,
            ]);

            $response = [
                'message' => trans('api.stored'),
                'fav' => $fav,

            ];

            return response($response,201);
        }

    }

    public function delete($id){

        $fav = Favorite::where('product_id',$id)->where('user_id',auth('sanctum')->user()->id)->first();
        if($fav){
            $fav->delete();

            $response = [
                'message' => trans('api.deleted'),

            ];

            return response($response,201);

        }else{
            return response('not exist',404);
        }
    }

    public function index(Request $request){
        $fav = Favorite::with(['product' => function ($q){
            return $q->select([
                'id',
                'name_'.app()->getLocale().' as name',
                'description_'.app()->getLocale().' as description',
                'price',
                'have_discount',
                'discounted_price',
                'category_id',
                'img',
                'isfish',



            ]);
        }])->where('user_id',$request->user()->id)->get();
        $response = [
            'message' => trans('api.fetch'),
            'data' => $fav->pluck('product'),

        ];

        return response($response,201);



    }
}

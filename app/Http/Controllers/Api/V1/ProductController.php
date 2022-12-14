<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function search(Request $request){

        $products = Product::where('name','LIKE','%'.$request->q.'%')->get();
        $response = [
            'message' => trans('api.stored'),
            'data' => $products,

        ];

        return response($response,201);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|max:150',
            'name_ar'=> 'required|max:150',
            'description_en'=> 'max:500',
            'description_ar'=> 'max:500',
            'price'=> 'required',
            'have_discount'=> 'boolean',
            'discounted_price'=> 'numeric',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id'=> 'required|exists:categories,id',
        ]);


        $image_path = $request->file('img')->store('api/products','public');
        $isfish = ($request->category_id == 1) ? true : false;




        $product = Product::create([
            'name_en' => $request->name_en,
            'name_ar'=> $request->name_ar,
            'description_en'=> $request->description_en,
            'description_ar'=> $request->description_ar,
            'price'=> $request->price,
            'have_discount'=> $request->have_discount,
            'discounted_price'=> $request->discounted_price,
            'img' => asset('storage/'.$image_path),
            'isfish' => $isfish,
            'category_id'=> $request->category_id,

        ]);
        $response = [
            'message' => trans('api.stored'),
            'data' => $product,

        ];

        return response($response,201);
        //
    }

    public function index()
    {
        $products = Product::select(
            'id',
            'name_'.app()->getLocale().' as name',
            'description_'.app()->getLocale().' as description',
            'price',
            'have_discount',
            'discounted_price',
            'category_id',
            'img',
            'isfish',

            )->get();
            $response = [
                'message' =>  trans('api.fetch'),
                'count' => count($products) ,
                'data' => $products,

            ];

            return response($response,201);

        //
    }

    public function show(Request $request,$id){
        $product = Product::select(
            'id',
            'name_'.app()->getLocale().' as name',
            'description_'.app()->getLocale().' as description',
            'price',
            'have_discount',
            'discounted_price',
            'category_id',
            'img',
            'isfish',

            )->where('id',$id)->first();

        if($product){


            $item = Item::where('product_id',$id)->first();
            if($request->user()){
                $user_id =$request->user()->id;


            if($item && $item->order_id && $user_id){

                $order = Order::findOrFail($item->order_id);
                if($order){
                    if($order->user_id == $user_id){
                        $can = true;
                    }

                }else{
                    $can = false;
                }

            }else{

            }
        }else{
            $can = false;
        }
            $response = [
                'message' =>  trans('api.fetch'),
                'data' => $product,
                'can rate' => $can,
            ];
            $stat = 201;



        }else{
            $response = [
                'message' =>  trans('api.notfound'),
                'data' => $product,
            ];
            $stat = 201;
            }

            return response($response,$stat);


    }

    public function CategoriesProduct($cat_d){
        $product = Product::select(
            'id',
            'name_'.app()->getLocale().' as name',
            'description_'.app()->getLocale().' as description',
            'price',
            'have_discount',
            'discounted_price',
            'category_id',
            'img',
            'isfish',

            )->where('category_id',$cat_d)->get();
        if($product){
            $response = [
                'message' =>  trans('api.fetch'),
                'count' => count($product) ,
                'data' => $product,
            ];
            $stat = 201;
        }else{
            $response = [
                'message' =>  trans('api.notfound'),
                'count' => count($product) ,
                'data' => $product,
            ];
            $stat = 201;
            }

            return response($response,$stat);

    }




}

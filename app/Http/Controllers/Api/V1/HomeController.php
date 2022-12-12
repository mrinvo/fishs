<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Home;
use App\Models\Debts;
use App\Models\Product;

class HomeController extends Controller
{
    //

    public function index(){
        $data = Home::select([
            'id',
            'text_'.app()->getLocale().' as text',
            'img',
            'mode',
            'wa_phone',
            'about_us_'.app()->getLocale().' as about_us',
            'deliver_policy_'.app()->getLocale().' as deliver_policy',
            'return_policy_'.app()->getLocale().' as return_policy',

        ])->where('id',1)->first();



        // $categories =  Category::with('products')->get();
        $categories =  Category::with(['products' => function ($q){
            $q->select([
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
        }])->get();
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
            'status' => true,
            'StatusCode' => 201,
            'message' => '',
            'home data' => $data,
            'categories' => $categories,
            'most selling' => $products,


        ];

        return $response;

    }


    public function store(Request $request){
        $data = Home::find(1);
        $data->text_en = $request->text_en;
        $data->text_ar = $request->text_ar;
        $image_path = $request->file('img')->store('api/home','public');
        $data->img = asset('storage/'.$image_path);
        $data->save();


        $count =  Category::all()->count();
        $response = [
            'status' => true,
            'StatusCode' => 201,
            'message' => 'تم التعديل  بنجاح',
            'video url' => $data->video_url,
            'landing_page_url' => $data->landing_page_url,
            'number of subscribers' => $count,
        ];

        return $response;





    }

    public function aboutus(){

        $about = Home::select([
            'about_us_'.app()->getLocale().' as about_us',
        ])->where('id',1)->first();
        $response = [
            'status' => true,
            'StatusCode' => 201,
            'data' => $about,

        ];

        return $response;

    }
    public function policy(){

        $about = Home::select([
            'policy_'.app()->getLocale().' as policy',
        ])->where('id',1)->first();
        $response = [
            'status' => true,
            'StatusCode' => 201,
            'data' => $about,

        ];

        return $response;

    }
}

<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoyController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|max:150',
            'name_ar' => 'required|max:150',
            'des_en' => 'required|max:150',
            'des_en' => 'required|max:150',
            'img' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $image_path = $request->file('img')->store('api/categories','public');
        $cat = Category::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'des_en' => $request->des_en,
            'des_ar' => $request->des_ar,
            'img' => asset('storage/'.$image_path),

        ]);
        $response = [
            'message' => ' category created successfuly',
            'data' => $cat,

        ];

        return response($response,201);
        //
    }

    public function index()
    {
        $categories = Category::select(
            'id',
            'name_'.app()->getLocale().' as name',
            'des_'.app()->getLocale().' as description',
            'img',

            )->get();
            $response = [
                'message' => count($categories) . ' categories retuned  successfuly',
                'count' => count($categories) ,
                'data' => $categories,

            ];

            return response($response,201);

        //
    }

    public function show($id){
        $cat = Category::select(
            'id',
            'name_'.app()->getLocale().' as name',
            'des_'.app()->getLocale().' as description',
            'img',

            )->where('id',$id)->first();
        if($cat){
            $response = [
               'message' => 'category retuned  successfuly',
                'data' => $cat,

            ];
            $stat = 201;
        }else{
            $response = [
                'message' => ' category not found',
                'data' => $cat,

            ];
            $stat = 201;
            }

            return response($response,$stat);


    }


}

<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Cleaning;
use Illuminate\Http\Request;

class CleaningController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|max:150',
            'name_ar' => 'required|max:150',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);
        $clean = Cleaning::create($request->all());
        $response = [
            'message' => ' cleaning type created successfuly',
            'data' => $clean,

        ];

        return response($response,201);
        //
    }

    public function index($cat_id)
    {
        $clean = Cleaning::select(
            'id',
            'name_'.app()->getLocale().' as name',
            'price',
            'category_id',

            )->where('category_id',$cat_id)->get();
            $response = [
                'message' => count($clean) . ' cleaning type retuned ',
                'count' => count($clean) ,
                'data' => $clean,

            ];

            return response($response,201);

        //
    }

    public function show($id){
        $clean = Cleaning::select(
            'id',
            'name_'.app()->getLocale().' as name',
            'price',
            'category_id',


            )->where('id',$id)->first();

        if($clean){
            $response = [
                'message' => 'cleaning type retuned  successfuly',

                'data' => $clean,

            ];
            $stat = 201;
        }else{
            $response = [
                'message' => ' cleaning type not found',
                'count' => count($clean) ,
                'data' => $clean,

            ];
            $stat = 404;
            }

            return response($response,$stat);


    }
}

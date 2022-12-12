<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|max:250',
            'city' => 'required|max:250',
            'building' => 'max:250',
            'emirate' => 'required|max:250',
            'name' => 'required|max:250',


        ]);
        $add = Address::create([
            'address' => $request->address,
            'city' => $request->city,
            'building' => $request->building,
            'emirate' => $request->emirate,
            'name' => $request->name,
            'user_id' => $request->user()->id,
        ]);
        $response = [
            'message' => trans('api.stored'),
            'data' => $add,

        ];

        return response($response,201);
        //
    }

    public function index(Request $request)
    {
        $add = Address::select(
            'id',
            'name',
            'address',
            'user_id',
            'city',
            'building',
            'emirate',


            )->where('user_id',$request->user()->id)
            ->get();


            $response = [
                'message' => trans('api.fetch'),
                'count' => count($add) ,
                'data' => $add,

            ];

            return response($response,201);

        //
    }
    public function show($id){
        $add = Address::select(
            'id',
            'name',
            'address',
            'user_id',
            'city',
            'building',
            'emirate',

            )->where('id',$id)->first();
        if($add){
            $response = [
               'message' => trans('api.fetch'),
                'data' => $add,

            ];
            $stat = 201;
        }else{
            $response = [
                'message' => trans('api.notfound'),
                'data' => $add,

            ];
            $stat = 404;
            }

            return response($response,$stat);


    }

    public function delete($id)
    {
        # code...

        $add = Address::findOrFail($id);
        if($add){
            $add->delete();
            $response = [
               'message' => trans('api.deleted'),
                'data' => $add,

            ];
            $stat = 201;
        }else{
            $response = [
                'message' => trans('api.notfound'),
                'data' => $add,

            ];
            $stat = 201;
            }
            return response($response,$stat);
    }

    public function update(Request $request,$id)
    {
        # code...

        $request->validate([
            'address' => 'required|max:250',
            'city' => 'required|max:250',
            'building' => 'max:250',
            'emirate' => 'required|max:250',
            'name' => 'required|max:250',

        ]);



        $add = Address::findOrFail($id);

        if(!$add || $add->user_id != $request->user()->id){
            return response(trans('api.notallowed',422));
        }

        $add->address = $request->address;
        $add->city = $request->city;
        $add->building = $request->building;
        $add->emirate = $request->emirate;
        $add->name = $request->name;

        $add->save();

        $response = [
            'message' => trans('api.stored'),

            'data' => $add,

        ];

        return response($response,201);




    }

}

<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\DebtsRequest;
use App\Models\Debts;
use Illuminate\Support\Facades\Auth;

class DebtsController extends Controller
{

    public function store(DebtsRequest $request){


        $userid = $request->user()->id;

        $debt = Debts::create([

            'finance_type'=>$request->finance_type,
            'finance_name'=> $request->finance_name,
            'finance_main_amount'=>$request->finance_main_amount,
            'benifits_amount'=>$request->benifits_amount,
            'total_amount'=>$request->total_amount,
            'notes'=>$request->notes,
            'user_id'=>$userid
    ]);

    $response = [
        'status' => true,
        'StatusCode' => 201,
        'message' => 'تم الاضافة بنجاح',
        'data' => $debt,
    ];

return $response;

}

public function count(){
    $count =  Debts::all()->count();
    $response = [
        'status' => true,
        'StatusCode' => 201,
        'message' => '',
        'data' => $count,
    ];

return $response;
}


    //
}

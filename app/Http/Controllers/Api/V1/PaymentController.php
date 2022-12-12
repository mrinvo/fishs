<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    //

    public function index(){
        $payments = Payment::select([
            'id',
            'name_' .app()->getLocale(). ' as name',
        ])->get();

        $response = [
            'message' =>  trans('api.fetch'),
            'data' => $payments,


        ];

        return response($response,201);
    }
}

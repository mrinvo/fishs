<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    //
    public function edit(){

        $data = Home::findOrFail(1);


        return view('admin.rules.update',compact('data'));

    }

    public function update(Request $request){

        $request->validate([
            'return_policy_en' => 'required',
            'return_policy_ar' => 'required',
            'deliver_policy_en' => 'required',
            'deliver_policy_ar' => 'required',
        ]);

        $home =  Home::findOrFail(1);




        $home->update([
            'return_policy_en' => $request->return_policy_en,
            'return_policy_ar' => $request->return_policy_ar,
            'deliver_policy_en' => $request->deliver_policy_en,
            'deliver_policy_ar' => $request->deliver_policy_ar,
        ]);

        return redirect()->back();


    }
}

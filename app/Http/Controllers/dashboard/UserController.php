<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //
    public function index(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    public function create(){



        return view('admin.users.store');
    }


    public function store(Request $request){


        $request->validate([
            'name_en' => 'required|max:150',
            'name_ar'=> 'required|max:150',
            'description_en'=> 'max:500',
            'description_ar'=> 'max:500',
            'price'=> 'required',
            'have_discount'=> 'boolean',
            'discounted_price'=> '',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id'=> 'required|exists:categories,id',
        ]);
        $image_path = $request->file('img')->store('api/Users','public');
        $isfish = ($request->category_id == 1) ? true : false;




        $User = User::create([
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



        return redirect()->route('admin.User.index');
    }

    public function edit($id){

        $User = User::findOrFail($id);


        return view('admin.Users.update',compact('User'));

    }

    public function update(Request $request){

        $request->validate([

            'name_en' => 'required|max:150',
            'name_ar'=> 'required|max:150',
            'description_en'=> 'max:500',
            'description_ar'=> 'max:500',
            'price'=> 'required',
            'have_discount'=> 'boolean',
            'discounted_price'=> '',
            'category_id'=> 'required|exists:categories,id',

        ]);

        $cat =  User::findOrFail($request->id);
        $isfish = ($request->category_id == 1) ? true : false;



        $cat->update([
            'name_en' => $request->name_en,
            'name_ar'=> $request->name_ar,
            'description_en'=> $request->description_en,
            'description_ar'=> $request->description_ar,
            'price'=> $request->price,
            'have_discount'=> $request->have_discount,
            'discounted_price'=> $request->discounted_price,
            'isfish' => $isfish,
            'category_id'=> $request->category_id,


        ]);

        if($request->file('img')){
            $image_path = $request->file('img')->store('api/Users','public');
            $cat->img = asset('storage/'.$image_path);
            $cat->save();
        }

        return redirect()->route('admin.User.index');


    }
    public function delete($id){


        $cat = User::findOrFail($id);

        $cat->delete();
        return redirect()->route('admin.User.index');



    }
}

<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function index(){
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    public function create(){

        return view('admin.categories.store');
    }


    public function store(Request $request){


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



        return redirect()->route('admin.category.index');
    }

    public function edit($id){

        $category = Category::findOrFail($id);

        return view('admin.categories.update',compact('category'));

    }

    public function update(Request $request){

        $request->validate([

            'name_en' => 'required|max:150',
            'name_ar' => 'required|max:150',
            'des_en' => 'required|max:150',
            'des_en' => 'required|max:150',

        ]);

        $cat =  Category::findOrFail($request->id);



        $cat->update([

            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'des_en' => $request->des_en,
            'des_ar' => $request->des_ar,

        ]);

        if($request->file('img')){
            $image_path = $request->file('img')->store('api/categories','public');
            $cat->img = asset('storage/'.$image_path);
            $cat->save();
        }

        return redirect()->route('admin.category.index');


    }
    public function delete($id){
        if($id == 1){
            die(404);
        }

        $cat = Category::findOrFail($id);

        $cat->delete();
        return redirect()->route('admin.category.index');



    }
}

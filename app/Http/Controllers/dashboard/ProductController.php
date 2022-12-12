<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    public function create(){

        $categories = Category::all();

        return view('admin.products.store',compact('categories'));
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



        return redirect()->route('admin.product.index');
    }

    public function edit($id){

        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.update',compact('product','categories'));

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

        $cat =  Product::findOrFail($request->id);
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
            $image_path = $request->file('img')->store('api/products','public');
            $cat->img = asset('storage/'.$image_path);
            $cat->save();
        }

        return redirect()->route('admin.product.index');


    }
    public function delete($id){


        $cat = Product::findOrFail($id);

        $cat->delete();
        return redirect()->route('admin.product.index');



    }
}

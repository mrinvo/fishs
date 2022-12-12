<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Cleaning;

class CleaningController extends Controller
{
    //
    public function index(){
        $cleanings = Cleaning::all();
        return view('admin.cleanings.index',compact('cleanings'));
    }

    public function create(){

        $categories = Category::all();

        return view('admin.cleanings.store',compact('categories'));
    }


    public function store(Request $request){


        $request->validate([
            'name_en' => 'required|max:150',
            'name_ar' => 'required|max:150',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        $cat = Cleaning::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'category_id' => $request->category_id,

        ]);



        return redirect()->route('admin.cleaning.index');
    }

    public function edit($id){

        $cleaning = Cleaning::findOrFail($id);
        $categories = Category::all();

        return view('admin.cleanings.update',compact('cleaning','categories'));

    }

    public function update(Request $request){

        $request->validate([

            'name_en' => 'required|max:150',
            'name_ar' => 'required|max:150',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'

        ]);

        $cat =  Cleaning::findOrFail($request->id);



        $cat->update([

            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);



        return redirect()->route('admin.cleaning.index');


    }
    public function delete($id){


        $clean = Cleaning::findOrFail($id);

        $clean->delete();
        return redirect()->route('admin.cleaning.index');



    }
}

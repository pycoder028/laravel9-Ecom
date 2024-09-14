<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function Index(){
        $subcategories = Subcategory::orderBy('id' ,'desc')->get();

        return view("admin.allsubcategory",compact("subcategories"));
    }

    public function AddSubCategory(){
        $categories = Category::latest()->get();

        return view("admin.addsubcategory",compact("categories"));
    }

    public function StoreSubCategory(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:subcategories',
            'category_id' => 'required'
        ]);
        $category_id = $request->category_id;

        $category_name = Category::where('id', $category_id)->value('category_name');

        Subcategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ','-', $request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name,
        ]);

        Category::where('id',$category_id)->increment('subcategory_count',1);

        toastr()->timeOut(5000)->closeButton()->addSuccess('Subcategory Added Successfully!');

        return redirect()->route('allsubcategory')->with('message','Subcategory Added Successfully!');
    }

}

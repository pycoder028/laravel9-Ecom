<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Index(){
        //$categories = Category::latest()->get();
        $categories = Category::orderBy('id' ,'desc')->get();

        return view("admin.allcategory", compact("categories"));
    }

    public function AddCategory(){

        return view("admin.addcategory");
    }

    public function StoreCategory(Request $request){  

        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-', $request->category_name)),
        ]);

        toastr()->timeOut(5000)->closeButton()->addSuccess('Category Added Successfully!');

        return redirect()->route('allcategory')->with('message','Category Added Successfully!');

    }

    public function EditCategory($id){
        $category = Category::findOrFail($id);
        
        return view('admin.editcategory', compact('category'));
    }
    public function UpdateCategory(Request $request){
        $category_id = $request->category_id;

        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ','-', $request->category_name)),
        ]);

        toastr()->timeOut(5000)->closeButton()->addSuccess('Category Updated Successfully!');
        return redirect()->route('allcategory')->with('message','Category Updated Successfully!');
    }

    public function DeleteCategory($id){
        Category::findOrFail($id)->delete();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Category Deleted Successfully!');
        return redirect()->route('allcategory')->with('message','Category Deleted Successfully!');
    }



}

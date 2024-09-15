<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;

class ProductController extends Controller
{
    public function Index(){
        $products = Product::orderBy('id' ,'desc')->get();

        return view("admin.allproducts",compact("products"));
    }

    public function AddProduct(){
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();

        return view("admin.addproduct",compact("categories","subcategories"));
    }

    public function StoreProduct(Request $request){

        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'product_quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $image = $request->file('product_img');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $image_name);
        $image_url = 'upload/'. $image_name;

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_img' => $image_url,
            'product_quantity' => $request->product_quantity,
            'slug' => strtolower(str_replace(' ','-', $request->product_name)), 
        ]);
        Category::where('id', $category_id)->increment('product_count',1);
        Subcategory::where('id', $subcategory_id)->increment('product_count',1);

        toastr()->timeOut(5000)->closeButton()->addSuccess('Product Added Successfully!');

        return redirect()->route('allproducts')->with('message','Product Added Successfully!');
    }

    public function EditProductImg($id){

        $product = Product::findOrFail($id);

        return view('admin.editproductimg',compact('product'));
    }

    public function UpdateProductImg(Request $request){
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $id = $request->id;
        $image = $request->file('product_img');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $image_name);
        $image_url = 'upload/'. $image_name;

        Product::findOrfail($id)->update([
            'product_img' => $image_url,
        ]);
        toastr()->timeOut(5000)->closeButton()->addSuccess('Product Image Updated Successfully!');

        return redirect()->route('allproducts')->with('message','Product Image Updated Successfully!');
    }

    public function EditProduct($id){
        $product = Product::findOrFail($id);

        return view('admin.editproduct', compact('product'));
    }

    public function UpdateProduct(Request $request){
        $productid = $request->id;

        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'product_quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
        ]);

        Product::findOrFail($productid)->update([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_quantity' => $request->product_quantity,
            'slug' => strtolower(str_replace(' ','-', $request->product_name)), 
        ]);
        toastr()->timeOut(5000)->closeButton()->addSuccess('Product Updated Successfully!');

        return redirect()->route('allproducts')->with('message','Product Updated Successfully!');
    }

    public function DeleteProduct($id){
        $cat_id = Product::where('id',$id)->value('product_category_id');
        $subcat_id = Product::where('id',$id)->value('product_subcategory_id');

        Product::findOrFail($id)->delete();

        Category::where('id',$cat_id)->decrement('product_count',1);
        Subcategory::where('id',$subcat_id)->decrement('product_count',1);

        toastr()->timeOut(5000)->closeButton()->addSuccess('Product Deleted Successfully!');

        return redirect()->route('allproducts')->with('message','Product Deleted Successfully!');
    }


}

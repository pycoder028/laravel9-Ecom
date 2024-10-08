<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ClientConroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function(){
    Route::get('/','Index')->name('home');
});

Route::controller(ClientConroller::class)->group(function(){
    Route::get('/category','CategoryPage')->name('category');
    Route::get('/single-product','SinglePost')->name('singlepost');
    Route::get('/add-to-cart','AddToCart')->name('addtocart');
    Route::get('/checkout','Checkout')->name('checkout');
    Route::get('/user-profile','UserProfile')->name('userprofile');
    Route::get('/new-release','NewRelease')->name('newrelease');
    Route::get('/todays-deal','TodaysDeal')->name('todaysdeal');
    Route::get('/customer-service','CustomerService')->name('customerservice');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* admin group rotues */
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('admin/dashboard','Index')->name('admindashboard');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category','Index')->name('allcategory');
        Route::get('/admin/add-category','AddCategory')->name('addcategory');
        Route::post('/admin/store-category','StoreCategory')->name('storecategory');
        Route::get('/admin/edit-category/{id}','EditCategory')->name('editcategory');
        Route::post('/admin/update-category','UpdateCategory')->name('updatecategory');
        Route::get('/admin/delete-category/{id}','DeleteCategory')->name('deletecategory');
        
    });

    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/all-subcategory','Index')->name('allsubcategory');
        Route::get('/admin/add-subcategory','AddSubCategory')->name('addsubcategory');
        Route::post('/admin/store-subcategory','StoreSubCategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{id}','EditSubCategory')->name('editsubcategory');
        Route::post('/admin/update-subcategory','UpdateSubCategory')->name('updatesubcategory');
        Route::get('/admin/delete-subcategory/{id}','DeleteSubCategory')->name('deletesubcategory');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-products','Index')->name('allproducts');
        Route::get('/admin/add-products','AddProduct')->name('addproduct');
        Route::post('/admin/store-product','StoreProduct')->name('storeproduct');
        Route::get('/admin/edit-product-img/{id}','EditProductImg')->name('editproductimg');
        Route::post('/admin/update-product-image','UpdateProductImg')->name('updateimageproduct');
        Route::get('/admin/edit-product/{id}','EditProduct')->name('editproduct');
        Route::post('/admin/update-product','UpdateProduct')->name('updateproduct');
        Route::get('/admin/delete-product/{id}', 'DeleteProduct')->name('deleteproduct');

    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/pending-order','Index')->name('pendingorder');
    });


});


require __DIR__.'/auth.php';

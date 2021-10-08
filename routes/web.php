<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\BannerController;


use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/ ', [AdminController::class, 'index']);
Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware' => 'AdminAuth'], function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);


    // Routes for category
    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/add', [CategoryController::class, 'manage_category_action']);
    Route::post('admin/category/manage_category_process', [CategoryController::class, 'manage_category_process'])->name('manage_category_process');
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'manage_category_action']);
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('admin/category/status/{status}/{id}', [CategoryController::class, 'status']);



    // routes for coupon
    Route::get('admin/coupon', [CouponController::class, 'index']);
    Route::get('admin/coupon/add', [CouponController::class, 'manage_coupon_action']);
    Route::post('admin/coupon/manage_coupon_process', [CouponController::class, 'manage_coupon_process'])->name('manage_coupon_process');
    Route::get('admin/coupon/edit/{id}', [CouponController::class, 'manage_coupon_action']);
    Route::get('admin/coupon/delete/{id}', [CouponController::class, 'delete']);

    Route::get('admin/coupon/status/{status}/{id}', [CouponController::class, 'status']);


    // routes for Sizes
    Route::get('admin/size', [SizeController::class, 'index']);
    Route::get('admin/size/add', [SizeController::class, 'manage_size_action']);
    Route::post('admin/size/manage_size_process', [SizeController::class, 'manage_size_process'])->name('manage_size_process');
    Route::get('admin/size/edit/{id}', [SizeController::class, 'manage_size_action']);
    Route::get('admin/size/delete/{id}', [SizeController::class, 'delete']);
    Route::get('admin/size/status/{status}/{id}', [SizeController::class, 'status']);



    // Routes for Color master
    Route::get('admin/color', [ColorController::class, 'index']);
    Route::get('admin/color/add', [ColorController::class, 'manage_color_action']);
    Route::post('admin/color/manage_color_process', [ColorController::class, 'manage_color_process'])->name('manage_color_process');
    Route::get('admin/color/edit/{id}', [ColorController::class, 'manage_color_action']);
    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete']);
    Route::get('admin/color/status/{status}/{id}', [ColorController::class, 'status']);

    // Routes for Brand master
    Route::get('admin/brand', [BrandController::class, 'index']);
    Route::get('admin/brand/add', [BrandController::class, 'manage_brand_action']);
    Route::post('admin/brand/manage_brand_process', [BrandController::class, 'manage_brand_process'])->name('manage_brand_process');
    Route::get('admin/brand/edit/{id}', [BrandController::class, 'manage_brand_action']);
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete']);
    Route::get('admin/brand/status/{status}/{id}', [BrandController::class, 'status']);

    // Routes for Banner master
    Route::get('admin/banner', [BannerController::class, 'index']);
    Route::get('admin/banner/add', [BannerController::class, 'manage_banner_action']);
    Route::post('admin/banner/manage_banner_process', [BannerController::class, 'manage_banner_process'])->name('manage_banner_process');
    Route::get('admin/banner/edit/{id}', [BannerController::class, 'manage_banner_action']);
    Route::get('admin/banner/delete/{id}', [BannerController::class, 'delete']);
    Route::get('admin/banner/status/{status}/{id}', [BannerController::class, 'status']);


    // routes for Taxes
    Route::get('admin/tax', [TaxController::class, 'index']);
    Route::get('admin/tax/add', [TaxController::class, 'manage_tax_action']);
    Route::post('admin/tax/manage_tax_process', [TaxController::class, 'manage_tax_process'])->name('manage_tax_process');
    Route::get('admin/tax/edit/{id}', [TaxController::class, 'manage_tax_action']);
    Route::get('admin/tax/delete/{id}', [TaxController::class, 'delete']);
    Route::get('admin/tax/status/{status}/{id}', [TaxController::class, 'status']);

    // routes for Customers
    Route::get('admin/customer', [CustomerController::class, 'index']);

    Route::get('admin/customer/show/{id}', [CustomerController::class, 'show']);

    Route::get('admin/customer/delete/{id}', [CustomerController::class, 'delete']);
    Route::get('admin/customer/status/{status}/{id}', [CustomerController::class, 'status']);

    //Product Routes 
    Route::get('admin/product', [ProductController::class, 'index']);
    Route::get('admin/product/add', [ProductController::class, 'manage_product_action']);
    Route::post('admin/product/manage_product_process', [ProductController::class, 'manage_product_process'])->name('manage_product_process');
    Route::get('admin/product/edit/{id}', [ProductController::class, 'manage_product_action']);
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('admin/product/status/{status}/{id}', [ProductController::class, 'status']);
    Route::get('admin/product/product_attr_delete/{paid}/{pid}', [ProductController::class, 'delete_product_attr']);

    Route::get('admin/product/product_images_delete/{piid}/{pid}', [ProductController::class, 'delete_product_images']);






    // we can do logout in both ways. either call Admin controller or do it in the routes
    // method 1
    // Route::get('admin/logout', [AdminController::class, 'logout']);
    // method 2
    Route::get('admin/logout', function () {
        session()->flush();
        session()->flash('msg', 'Logout Succesful');
        return redirect('admin');
    });
});


Route::get('/front/product/{slug}', [FrontController::class, 'product']);

Route::get('/front', [FrontController::class, 'index']);
Route::get('front/home_product/{product_slug}', [FrontController::class, 'product_slug']);

Route::post('add_to_cart', [FrontController::class, 'add_to_cart']);
Route::get('front/cart', [FrontController::class, 'cart']);


<?php

use Illuminate\Support\Facades\Route;




//Login
Route::get('/admin/loginview', [App\Http\Controllers\Authentication\AdminLoginController::class, 'AdminLoginView'])->name('adminloginview');
Route::post('/admin/loginstore', [App\Http\Controllers\Authentication\AdminLoginController::class, 'AdminLoginStore'])->name('loginstore');

Route::group(['middleware' => ['admin']], function () {
    
    Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class,'DasboardView'])->name('dashboardview');
    Route::get('/admin/logout', [App\Http\Controllers\Authentication\AdminLoginController::class, 'AdminLogout'])->name('logout');

    //category
    Route::get('/category', [App\Http\Controllers\Backend\CategoryController::class, 'CategoryView'])->name('categoryview');
    Route::post('/category/store', [App\Http\Controllers\Backend\CategoryController::class, 'CategoryStore'])->name('categorystore');
    Route::get('/getcategorydata', [App\Http\Controllers\Backend\CategoryController::class, 'getCategoryData'])->name('categorydata');
    Route::get('/getcategory/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'getCategoryById'])->name('getcategorybyid');
    Route::get('/category/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'deleteCategory'])->name('deletecategory');

    //Brand
    Route::get('/brand', [App\Http\Controllers\Backend\BrandController::class, 'BrandView'])->name('brandview');
    Route::post('/brandstore', [App\Http\Controllers\Backend\BrandController::class, 'BrandStore'])->name('brandstore');
    Route::get('/getbranddata', [App\Http\Controllers\Backend\BrandController::class, 'getBrandData'])->name('branddata');
    Route::get('/getbrand/{id}', [App\Http\Controllers\Backend\BrandController::class, 'getBrandById'])->name('getbrandbyid');
    Route::get('/brand/{id}', [App\Http\Controllers\Backend\BrandController::class, 'deleteBrand'])->name('deletebrand');

    //Product
    Route::get('/product', [App\Http\Controllers\Backend\ProductController::class, 'ProductView'])->name('productview');
    Route::post('/productstore', [App\Http\Controllers\Backend\ProductController::class, 'ProductStore'])->name('productstore');
    Route::get('/getproductdata', [App\Http\Controllers\Backend\ProductController::class, 'getProductData'])->name('productdata');
    Route::get('/getproduct/{id}', [App\Http\Controllers\Backend\ProductController::class, 'getProductById'])->name('getproductbyid');
    //Route::get('/product/{id}', [App\Http\Controllers\Backend\ProductController::class, 'deleteProduct'])->name('deleteproduct');
    
});
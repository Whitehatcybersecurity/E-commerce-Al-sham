<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

require base_path('routes/admin.php');

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'HomeView'])->name('homeview');

//Auth
Route::get('/registerview', [App\Http\Controllers\Frontend\RegisterController::class, 'RegisterView'])->name('registerview');
Route::get('/loginview', [App\Http\Controllers\Frontend\LoginController::class, 'LoginView'])->name('loginview');
Route::post('/register/store', [App\Http\Controllers\Frontend\RegisterController::class, 'RegisterStore'])->name('registerstore');
Route::post('/customer/loginstore',[App\Http\Controllers\Frontend\LoginController::class, 'CustomerLogin'])->name('cusromer.loginstore');

Route::get('/forgotpassword/view', [App\Http\Controllers\Frontend\ForgotpasswordController::class, 'ForgotpasswordView'])->name('forgotpasswordview');
Route::post('/forgotpassword/store', [App\Http\Controllers\Frontend\ForgotpasswordController::class, 'ForgotpasswordStore'])->name('forgotpassword.store');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/customerlogout', [App\Http\Controllers\Frontend\LoginController::class, 'CustomerLogout'])->name('customerlogout');
    Route::get('/productdetails/view/{id}', [App\Http\Controllers\Frontend\ProductdetailController::class, 'productdetailsview'])->name('productdetailsview');
    Route::get('/cart/view', [App\Http\Controllers\Frontend\CartController::class, 'CartView'])->name('cartview');
    Route::get('/carts/products', [App\Http\Controllers\Frontend\CartController::class, 'AddtoCart'])->name('addtocart');
    Route::get('/carts/products/delete/{id}', [App\Http\Controllers\Frontend\CartController::class, 'CartProductdelete'])->name('cartproduct.delete');

    // Route::post('/order/store', [App\Http\Controllers\])
});


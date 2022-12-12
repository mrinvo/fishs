<?php

use App\Http\Controllers\Api\V1\AddressController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CategoyController;
use App\Http\Controllers\Api\V1\CleaningController;
use App\Http\Controllers\Api\V1\DebtsController;
use App\Http\Controllers\Api\V1\FavoriteController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\password\ForgotPasswordController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\RateController;
use App\Models\Favorite;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1' ,'middleware' => 'lang'], function () {

    //guest routes


    Route::post('/register',[UserController::class,'Register']);
    Route::post('/verify',[UserController::class,'verify'])->middleware('auth:sanctum');


    Route::post('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');
    Route::post('/login',[UserController::class,'login']);
    Route::get('/user/profile',[UserController::class,'profile'])->middleware('auth:sanctum');
    Route::post('/user/updateprofile',[UserController::class,'updateprofile'])->middleware('auth:sanctum');
    //password reset

    Route::post('/apforget-password', [UserController::class, 'ForgetPasswordEmail']);
    Route::post('/resetverify',[UserController::class,'resetverify']);
    Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware('auth:sanctum');

    // Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);

    Route::post('/Regenerate',[UserController::class,'Regenerate'])->middleware('auth:sanctum');
    Route::get('/rules',[UserController::class,'rules']);
    Route::put('updaterules',[UserController::class , 'updaterules']);

    // Categories start
    Route::get('/categories/index',[CategoyController::class,'index']);
    Route::get('/categories/show/{id}',[CategoyController::class,'show']);
    Route::post('/categories/store',[CategoyController::class,'store']);

    // Categories end

    // Cleaning start
    Route::get('/cleaning/index/{cat_id}',[CleaningController::class,'index']);
    Route::get('/cleaning/show/{id}',[CleaningController::class,'show']);
    Route::post('/cleaning/store',[CleaningController::class,'store']);

    // Cleaning end

    //address start

    Route::post('/address/store',[AddressController::class,'store'])->middleware('auth:sanctum');
    Route::get('/address/index',[AddressController::class,'index'])->middleware('auth:sanctum');
    Route::get('/address/show/{id}',[AddressController::class,'show'])->middleware('auth:sanctum');
    Route::post('/address/update/{id}',[AddressController::class,'update'])->middleware('auth:sanctum');
    Route::post('/address/delete/{id}',[AddressController::class,'delete'])->middleware('auth:sanctum');

    //address end

    //products start
    Route::post('/product/store',[ProductController::class,'store']);
    Route::get('/product/index',[ProductController::class,'index']);
    Route::get('/product/show/{id}',[ProductController::class,'show']);
    Route::get('/product/category/{cat_id}',[ProductController::class,'CategoriesProduct']);
    Route::get('/product/check/{id}',[ProductController::class,'check']);

    //products end


    //rates start
    Route::post('/rates/add',[RateController::class,'store'])->middleware('auth:sanctum');
    Route::get('/rates/ratesperproduct/{product_id}',[RateController::class,'ProductRates']);
    //rates end

    //cart start

    //   user start
    Route::post('/cart/user/store',[CartController::class,'userstore'])->middleware('auth:sanctum');
    Route::get('/cart/user/index',[CartController::class,'userindex'])->middleware('auth:sanctum');
    Route::post('/cart/user/update/{id}',[CartController::class,'userupdate'])->middleware('auth:sanctum');
    Route::post('/cart/user/delete/{id}',[CartController::class,'userdelete'])->middleware('auth:sanctum');
    Route::get('/cart/user/count',[CartController::class,'usercount'])->middleware('auth:sanctum');
    Route::post('/order/user/store',[OrderController::class,'userstore'])->middleware('auth:sanctum');
    Route::post('/order/user/index',[OrderController::class,'myorders'])->middleware('auth:sanctum');

    //   user end

    //   guest start
    Route::post('/cart/guest/store',[CartController::class,'gueststore']);
    Route::get('/cart/guest/index',[CartController::class,'guestindex']);
    Route::post('/cart/guest/update/{id}',[CartController::class,'guestupdate']);
    Route::post('/cart/guest/delete/{id}',[CartController::class,'guestdelete']);
    Route::get('/cart/guest/count',[CartController::class,'guestcount']);
    Route::post('/order/guest/store',[OrderController::class,'gueststore']);
    Route::post('/order/guest/index',[OrderController::class,'guestorders']);

    //   guest end



    //cart end

    // start favorite
    Route::post('/favorite/add',[FavoriteController::class,'add'])->middleware('auth:sanctum');
    Route::post('/favorite/delete/{id}',[FavoriteController::class,'delete'])->middleware('auth:sanctum');
    Route::post('/favorite/index',[FavoriteController::class,'index'])->middleware('auth:sanctum');

    // end favorite














    Route::get('/home',[HomeController::class,'index']);
    Route::get('/home/aboutus',[HomeController::class,'aboutus']);
    Route::get('/home/policy',[HomeController::class,'policy']);

    Route::put('/home/update',[HomeController::class,'store'])->middleware('auth:sanctum');



    //protected routes



});

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\AdController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\CleaningController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\dashboard\OrderController;
use App\Http\Controllers\dashboard\RuleController;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('admin');

Route::get('login', [AuthenticatedSessionController::class, 'create'])
->name('login');



  Route::get('/dashboard/home', [HomeController::class,'home'])->middleware(['admin'])->name('dashboard');



Route::prefix('/dashboard')->name('admin.')->group(function (){


    Route::middleware('admin')->group(function () {

        Route::get('/logout',[AdController::class,'destroy'])->name('logout');
        Route::get('/profile',[AdController::class,'profile'])->name('profile');
        Route::get('/edit-profile',[AdController::class,'edit_profile'])->name('profile.edit');
        Route::post('/update-profile',[AdController::class,'update_profile'])->name('profile.update');
        Route::get('/change-password',[AdController::class,'change_password'])->name('password.change');
        Route::post('/update-password',[AdController::class,'update_password'])->name('password.update');
        Route::get('delete/{id}',[AdController::class,'delete'])->name('delete');
        Route::get('/adduser',[AdController::class,'adduser'])->name('adduser');
        Route::post('/storeuser',[AdController::class,'storeuser'])->name('storeuser');
        Route::get('/edituser/{id}',[AdController::class,'edituser'])->name('edituser');
        Route::post('updateuser',[AdController::class,'updateuser'])->name('updateuser');

        //category routes

        Route::get('/category/index',[CategoryController::class,'index'])->name('category.index');
        Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
        Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('/category/update',[CategoryController::class,'update'])->name('cat
        egory.update');
        Route::get('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

        //end categories routes

        //cleaning routes

        Route::get('/cleaning/index',[CleaningController::class,'index'])->name('cleaning.index');
        Route::get('/cleaning/create',[CleaningController::class,'create'])->name('cleaning.create');
        Route::post('/cleaning/store',[CleaningController::class,'store'])->name('cleaning.store');
        Route::get('/cleaning/edit/{id}',[CleaningController::class,'edit'])->name('cleaning.edit');
        Route::post('/cleaning/update',[CleaningController::class,'update'])->name('cleaning.update');
        Route::get('/cleaning/delete/{id}',[CleaningController::class,'delete'])->name('cleaning.delete');

        //end cacleaning routes

        //product routes
        Route::post('/product/update',[ProductController::class,'update'])->name('product.update');
        Route::get('/product/index',[ProductController::class,'index'])->name('product.index');
        Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
        Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
        Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
        Route::get('/product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');

        //end product routes

        //rule routes
        Route::post('/rule/update',[RuleController::class,'update'])->name('rule.update');
        Route::get('/rule/edit',[RuleController::class,'edit'])->name('rule.edit');

        //end rule routes

        //orders routes
        Route::post('/order/update',[OrderController::class,'update'])->name('order.update');
        Route::get('/order/index/new',[OrderController::class,'indexnew'])->name('order.index.new');
        Route::get('/order/index/delivered',[OrderController::class,'indexdelivered'])->name('order.index.delivered');
        Route::get('/order/details/{id}',[OrderController::class,'details'])->name('order.details');
        Route::get('/order/create',[OrderController::class,'create'])->name('order.create');
        Route::post('/order/store',[OrderController::class,'store'])->name('order.store');
        Route::get('/order/edit/{id}',[OrderController::class,'edit'])->name('order.edit');
        Route::post('/order/status',[OrderController::class,'status'])->name('order.status');


        Route::get('/order/delete/{id}',[ProductController::class,'delete'])->name('order.delete');

        //end orders routes

        //user routes
        Route::post('/user/update',[UserController::class,'update'])->name('user.update');
        Route::get('/user/index',[UserController::class,'index'])->name('user.index');
        Route::get('/user/create',[UserController::class,'create'])->name('user.create');
        Route::post('/user/store',[UserController::class,'store'])->name('user.store');
        Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('user.edit');

        Route::get('/product/delete/{id}',[UserController::class,'delete'])->name('product.delete');

        //end cacleaning routes




    });
    require __DIR__.'/admin_auth.php';

});



//  require __DIR__.'/auth.php';

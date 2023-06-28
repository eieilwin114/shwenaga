<?php

use Illuminate\Http\Request;
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

use App\Models\User;

// User Attendances
Route::get('/user/attendances',         'App\Http\Controllers\Api\AttendanceController@index')->middleware('auth:sanctum')->name('user.attendances');
Route::post('/user/attendances',         'App\Http\Controllers\Api\AttendanceController@store')->middleware('auth:sanctum');
Route::get('/user/attendance',          'App\Http\Controllers\Api\AttendanceController@show')->middleware('auth:sanctum')->name('user.attendance');



Route::get('/users',function(){
    $users = User::paginate();
    return $users;
});


// User
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('api.user');
Route::post('/user/login',              'App\Http\Controllers\Api\AuthController@login')->name('login');

// Products
Route::get('/products',                 'App\Http\Controllers\Api\ProductController@index');
Route::get('/products/{product}',       'App\Http\Controllers\Api\ProductController@show');
Route::get('/tags/{tagId}/products',    'App\Http\Controllers\Api\ProductController@index');
Route::get('/products/search/{search}', 'App\Http\Controllers\Api\ProductController@index');

// Tags
Route::get('/tags',                     'App\Http\Controllers\Api\TagController@index');

// Cart
Route::get('/e-commerce/cart',           'App\Http\Controllers\Api\CartController@index')->middleware('auth:sanctum');
Route::post('/e-commerce/cart',          'App\Http\Controllers\Api\CartController@create')->middleware('auth:sanctum');
Route::put('/e-commerce/cart',           'App\Http\Controllers\Api\CartController@store')->middleware('auth:sanctum');
Route::post('/e-commerce/placeorder',    'App\Http\Controllers\Api\OrderController@store')->middleware('auth:sanctum');


// Order
Route::get('/orders',                  'App\Http\Controllers\Api\OrderController@index');
Route::get('/user/orders',             'App\Http\Controllers\Api\OrderController@index')->middleware('auth:sanctum')->name('user.orders');
Route::get('/user/order-items',        'App\Http\Controllers\Api\OrderController@indexOrderItem')->middleware('auth:sanctum')->name('user.orders');


// Roles
Route::get('/roles',                   'App\Http\Controllers\Api\RoleController@index');
Route::get('/roles/shop-owner/users',  'App\Http\Controllers\Api\UserController@index');

<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('tag', 'TagCrudController');
    //Route::crud('products', 'ProductsCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('order', 'OrderCrudController');
    // Route::crud('order-item', 'OrderItemCrudController');
    Route::resource('order-item', 'OrderItemController');
   
    Route::resource('users','UserController');
    Route::get('users','UserController@index')->name('users');
    Route::delete('users/{id}/destroy','UserController@destroy')->name('users.destroy');
    Route::post('users/search','UserController@search')->name('users.search');
    Route::get('users/search/reset','UserController@reset')->name('users.search.reset');
    
    // Route::crud('shop', 'ShopCrudController');
    // Route::crud('attendance', 'AttendanceCrudController');
    Route::resource('shop', 'ShopController');
    Route::resource('attendance', 'AttendanceController');
    Route::resource('division', 'DivisionController');
    Route::resource('township', 'TownshipController');
    Route::post('/salereport/search', 'OrderItemController@search')->name('salereport.search');
    Route::get('/salereport/reset', 'OrderItemController@reset')->name('salereport.search.reset');
    Route::post('/attendance/search', 'AttendanceController@search')->name('attendance.search');
    Route::get('/attendance/search/reset', 'AttendanceController@reset')->name('attendance.search.reset');
    Route::get('/salereport/shop', 'OrderItemController@shop')->name('order-item-shop');
    Route::post('/shopreport/search', 'OrderItemController@shopsearch')->name('shopreport.search');
    Route::get('/shopreport/reset', 'OrderItemController@shopreset')->name('shopreport.search.reset');
    Route::post('/shop/search', 'ShopController@search')->name('shop.search');
    Route::get('/shop/serarch/reset', 'ShopController@reset')->name('shop.search.reset');
    Route::post('/township/search', 'TownshipController@search')->name('township.search');
    Route::get('/township/serarch/reset', 'TownshipController@reset')->name('township.search.reset');

    Route::get('attendances-export','AttendanceController@export')->name('attendances.export');
    Route::get('sale-person-export','OrderItemController@salePersonExport')->name('sale-person.export');
    Route::get('shop-sale-report-export','OrderItemController@shopExport')->name('shop-sale-report.export');

    Route::resource('monthlyperformance','MonthlyPerformanceController');
    Route::post('monthlyperformance/search','MonthlyPerformanceController@search')->name('monthlyperformance.search');
    Route::get('monthlyperformance/search/reset','MonthlyPerformanceController@reset')->name('monthlyperformance.search.reset');
    Route::get('shops/township-by-division','TownshipController@get_all_townships_by_div')->name('township-by-division');
    Route::get('/shop/shops/get_all_townships_by_div','TownshipController@get_all_townships_by_div')->name('get-township-by-division');
    Route::get('/shop/{id}/shops/get_all_townships_by_div','TownshipController@get_all_townships_by_div')->name('get-township-by-division-edit');
    Route::get('user-by-shop','UserController@user_by_shop')->name('user-by-shop');
    Route::get('shops-by-division','ShopController@shops_by_division')->name('shops-by-division');
    Route::get('orders','OrderItemController@orders')->name('orders');
    Route::get('orders/{id}/view','OrderItemController@order_view')->name('order-view');
    Route::get('order-order-item/{id}/edit','OrderItemController@order_item_edit')->name('order-order-item-edit');
    Route::patch('order-order-item/{id}/update','OrderItemController@order_item_update')->name('order-order-item-update');    
    Route::post('orders-search','OrderItemController@order_search')->name('orders.search');
    Route::get('orders-reset','OrderItemController@order_reset')->name('orders.search.reset');

});

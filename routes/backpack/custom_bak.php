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
    Route::crud('user', 'UserCrudController');
    Route::crud('shop', 'ShopCrudController');
    // Route::crud('attendance', 'AttendanceCrudController');
    Route::resource('attendance', 'AttendanceController');
    Route::post('/salereport/search', 'OrderItemController@search')->name('salereport.search');
    Route::get('/salereport/reset', 'OrderItemController@reset')->name('salereport.search.reset');
    Route::post('/attendance/search', 'AttendanceController@search')->name('attendance.search');
    Route::get('/attendance/search/reset', 'AttendanceController@reset')->name('attendance.search.reset');
    Route::get('/salereport/shop', 'OrderItemController@shop')->name('order-item-shop');
    Route::post('/shopreport/search', 'OrderItemController@shopsearch')->name('shopreport.search');
    Route::get('/shopreport/reset', 'OrderItemController@shopreset')->name('shopreport.search.reset');

    Route::get('attendances-export','AttendanceController@export')->name('attendances.export');
    Route::get('sale-person-export','OrderItemController@salePersonExport')->name('sale-person.export');
    Route::get('shop-sale-report-export','OrderItemController@shopExport')->name('shop-sale-report.export');

    Route::resource('monthlyperformance','MonthlyPerformanceController');
    Route::post('monthlyperformance/search','MonthlyPerformanceController@search')->name('monthlyperformance.search');
    Route::get('monthlyperformance/search/reset','MonthlyPerformanceController@reset')->name('monthlyperformance.search.reset');
});

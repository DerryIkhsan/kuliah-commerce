<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::name('admin.')->group(function(){
//     Route::group(['prefix' => 'admin'], function(){
//         Route::resource('products', 'Admin\ProductController');
//     });
// });

Route::get('/admin/products/edit/{id}', 'Admin\ProductController@edit');
Route::post('/admin/products/update', 'Admin\ProductController@update');
Route::get('/admin/products/destroy/{id}', 'Admin\ProductController@destroy');
Route::get('image/view/{fileImage}', 'Admin\ProductController@viewImage')->name('image_url');
Route::get('video/view/{fileVideo}', 'Admin\ProductController@viewVideo')->name('video_url');

Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::post('/products/update', 'ProductController@update')->name('products.update');
Route::get('/products/image/{imageName}', 'ProductController@image')->name('products.image');

Route::get('/carts', 'CartController@index')->name('carts.index');
Route::get('/carts/checkout', 'CartController@checkout')->name('carts.checkout');
Route::get('/carts/add/{id}', 'CartController@add')->name('carts.add');
Route::patch('carts/update', 'CartController@update')->name('carts.update');
Route::delete('carts/remove', 'CartController@remove')->name('carts.remove');

Route::name('admin.')->group(function(){
    Route::group(['prefix' => 'admin'], function(){
        Route::resource('products', 'Admin\ProductController');
        Route::get('/products/image/{imageName}', 'Admin\ProductController@image')->name('products.image');
    
        Route::resource('orders', 'Admin\OrderController');
        Route::get('/orders/new/order', 'Admin\OrderController@new')->name('orders.new');
    });
});
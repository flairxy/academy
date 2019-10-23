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

use App\Gallery;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'HomeController@index')->name('home');
// Route::get('/gallery', 'GalleryController@gallery')->name('gallery');
Route::get('/our/gallery', function () {
    $images = Gallery::all();
    return view('mygallery', ['images' => $images]);
});


// Route::get('status', 'PaymentController@getPaymentStatus')->name('status');
// Route::get('payment', 'PaymentController@index');
Route::group(['middleware' => ['auth']], function () {
    Route::post('/checkout', 'PaymentController@createPayment')->name('create-payment');
    Route::get('/confirm', 'PaymentController@confirmPayment')->name('confirm-payment');
    Route::get('/checkout', 'PaymentController@index');
});

// Route::post('/category', 'PaymentController@getCategory')->name('get-category');


Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('management/{any}', 'HomeController@adminIndex')->where('any', '.*');
});


Route::group(['middleware' => ['auth', 'user']], function () {
    Route::get('{any}', 'HomeController@index')->where('any', '.*');
});

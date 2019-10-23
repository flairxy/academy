<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.', 'namespace' => 'API'], function () {
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth:api'], function () {
        Route::post('paypal/checkout', 'PaymentController@payWithpaypal');
        Route::group(['as' => '.course', 'prefix' => 'course'], function () {
            Route::get('index', 'CoursesController@index');
            Route::get('user/{id}/courses', 'CoursesController@userCourses');
            Route::post('create', 'CoursesController@create');
            Route::post('{id}/update', 'CoursesController@update');
            Route::post('{id}/delete', 'CoursesController@delete');
        });
        Route::group(['as' => '.content', 'prefix' => 'content'], function () {
            Route::get('index', 'ContentController@index');
            Route::get('/{userId}/contents/{courseId}', 'ContentController@contents');
            Route::post('create', 'ContentController@create');
            Route::post('{id}/update', 'ContentController@update');
            Route::post('{id}/delete', 'ContentController@delete');
            Route::post('file/upload', 'ContentController@upload');
            Route::post('file/images', 'ContentController@getImages');
            Route::post('file/{id}/delete', 'ContentController@deleteFile');
        });
        Route::group(['as' => '.user', 'prefix' => 'user'], function () {
            Route::get('index', 'UserController@index');
            Route::get('{id}/user', 'UserController@user');
            Route::get('subscriptions', 'UserController@subscriptions');
            Route::post('{id}/subscription/delete', 'UserController@deleteSub');
            Route::post('{id}/update', 'UserController@update');
            Route::post('{id}/delete', 'UserController@delete');
        });
        Route::group(['as' => '.category', 'prefix' => 'category'], function () {
            Route::get('index', 'CategoryController@index');
            Route::post('create', 'CategoryController@create');
            Route::post('{id}/update', 'CategoryController@update');
            Route::post('{id}/delete', 'CategoryController@delete');
        });
    });

    Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => 'auth:api'], function () {
        Route::get('index', 'UserController@index');
        Route::get('{id}/subscriptions', 'UserController@activeSubscriptions');
        Route::post('{id}/update', 'UserController@update');
        Route::post('{id}/password/update', 'UserController@updatePassword');
    });
});

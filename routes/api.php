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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::middleware(['basicAuth'])->group(function () {
    //All the routes are placed in here
    // Route::resource('books', 'BookController');
    Route::get('/books', 'BookController@index');
    Route::get('/book/{id}', 'BookController@show');
    Route::post('/book/store', 'BookController@store');
    Route::post('/book/update/{id}', 'BookController@update');
    Route::post('/book/delete', 'BookController@destroy');

    // login admin
    Route::post('/login-admin', 'LoginController@loginAct');

    // publisher
    Route::get('publishers', 'PublisherController@index');
    Route::post('publisher/store', 'PublisherController@store');



    // customer
    Route::post('customer/register', 'CustomerController@store');
    Route::post('customer/verifySuccess/{token}', 'CustomerController@verifySuccess');


    // Reset Password
    Route::post('customer/reset-password', 'ResetPasswordController@create');
    Route::post('customer/reset-password-success/{token}', 'ResetPasswordController@tokenSuccess');
    Route::post('customer/reset', 'ResetPasswordController@resetPassowrd');
});

Route::get('send/email', 'CustomerController@mail');

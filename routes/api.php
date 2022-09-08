<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Routes\Admin;

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
Route::group(['namespace'=>'App\Http\Controllers'], function () {
    Route::post('/register', 'Auth\UserAuthController@register');
    Route::post('/login', 'Auth\UserAuthController@login');

    Route::group(['prefix'=>'admin','middleware'=>['auth:api','admin']], function () {
        Admin::routes();
    });

    Route::group(['prefix'=>'loan','middleware'=>'auth:api'], function () {
        Route::post('/requested', 'LoanController@requested');
        
        Route::post('/pay-emi/{emi}/{loanRequest}', 'LoanEmiController@payEmi');
        Route::post('/all-transactions', 'TransactionController@index');
    
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

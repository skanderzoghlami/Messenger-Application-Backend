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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//this is the login route
Route::post('login','App\Http\Controllers\ApiAuthController@login')->name('login');
// this is the register route
Route::post('register','App\Http\Controllers\UserController@register');
//this is the conversation route defended by an authentification middlewarepg
Route::middleware('auth:api')->group(
    function()
    {
        Route::post('logout','App\Http\Controllers\ApiAuthController@logout');
        Route::get('conversations','App\Http\Controllers\ConversationController@index');
        Route::post('messages','App\Http\Controllers\MessageController@store');
        Route::post('store','App\Http\Controllers\ConversationController@store');
        Route::post('conversations/read','App\Http\Controllers\ConversationController@markAsReaded');
    }
);


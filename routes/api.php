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


Route::get('/terms_conditions_fetch', 'Api\AppSettingController@terms_conditions_fetch');
Route::post('/login', 'Api\UserController@login');
Route::post('/register', 'Api\UserController@register');
Route::post('/verify', 'Api\UserController@verify');
Route::post('/resend_verification', 'Api\UserController@resend_verification');


//Route::middleware('auth:api')->get('/user', function (Request $request) {
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});

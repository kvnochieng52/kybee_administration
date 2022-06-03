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


Route::prefix('app_settings')->group(function () {
    Route::post('/get_settings', 'Api\AppSettingController@get_settings');
    Route::post('/get_contact_details', 'Api\AppSettingController@get_contact_details');
    Route::get('/test', 'Api\AppSettingController@test');
});
/** MPESA routes */
Route::any('/transactions/get_access_token', 'Api\TransactionsController@get_access_token');
Route::any('/transactions/confirmation', 'Api\TransactionsController@confirmation_url');
Route::any('/transactions/validation', 'Api\TransactionsController@validation_url');
Route::any('/transactions/register', 'Api\TransactionsController@register_url');
Route::any('/transactions/send_loan', 'Api\TransactionsController@send_loan');
Route::any('/transactions/queue_time_url', 'Api\TransactionsController@queue_timeout_url');
Route::any('/transactions/result_url', 'Api\TransactionsController@result_url');

//
Route::prefix('profile')->group(function () {
    Route::post('/update', 'Api\ProfileController@update');
    Route::post('/details', 'Api\ProfileController@details');
    Route::post('/store_sms', 'Api\ProfileController@store_sms');
});


Route::prefix('loan')->group(function () {
    Route::post('/meta_init', 'Api\LoanController@meta_init');
    Route::post('/dashboard_init', 'Api\LoanController@dashboard_init');
    Route::post('/calculate_loan', 'Api\LoanController@calculate_loan');
    Route::post('/apply_loan', 'Api\LoanController@apply_loan');
    Route::post('/repayment_details', 'Api\LoanController@repayment_details');
    Route::post('/close_loan', 'Api\LoanController@close_loan');
});


Route::prefix('notification')->group(function () {
    Route::post('/get', 'Api\NotificationController@get');
});

Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});

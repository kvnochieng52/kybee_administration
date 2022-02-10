<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::resource('loans', 'LoanController');

    Route::prefix('loan')->group(function () {
        Route::get('{status_id}/status', 'LoanController@status');
        Route::get('pending_repayment', 'LoanController@pending_repayment');
        Route::get('over_due', 'LoanController@over_due');
        Route::get('due', 'LoanController@due');
        Route::get('paid', 'LoanController@paid');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/terms_and_conditions', 'SettingController@terms_conditions');
        Route::post('/terms_conditions_process', 'SettingController@terms_conditions_process');
    });
});

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

Route::group(['middleware' => 'auth'], function() {

	Route::resource('qrcodes', 'QrcodeController')->except(['show']);

	Route::resource('transactions', 'TransactionController');

	Route::resource('users', 'UserController');

	Route::resource('accounts', 'AccountController')->except(['show']);

	Route::get('/accounts/show/{id?}', 'AccountController@show')->name('accounts.show');

	Route::resource('accountHistories', 'AccountHistoryController');

	Route::resource('roles', 'RoleController')->middleware('checkadmin');

	Route::group(['middleware'=>'checkmoderator'], function(){
		Route::get('/users', 'UserController@index')->name('users.index');
	});

	Route::post('/accounts/apply_for_payout','AccountController@apply_for_payout')->name('accounts.apply_for_payout');

	Route::post('/accounts/mark_as_paid','AccountController@mark_as_paid')
		->name('accounts.mark_as_paid')
		->middleware('checkmoderator');

	Route::get('/accountHistories', 'AccountHistoryController@index')
		->name('accountHistories.index')->middleware('checkmoderator');

	Route::get('/accountHistories/create', 'AccountHistoryController@create')
		->name('accountHistories.create')->middleware('checkadmin');

	Route::get('/accountHistories', 'AccountHistoryController@index')
		->name('accountHistories.index')->middleware('checkmoderator');

	Route::get('/accountHistories/create', 'AccountHistoryController@create')
		->name('accountHistories.create')->middleware('checkadmin');

});

Route::get('/qrcodes/{id}', 'QrcodeController@show')->name('qrcodes.show');

Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');

Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
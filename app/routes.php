<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => LaravelLocalization::setLocale()), function(){
	Route::pattern('id', '[0-9]+');

	Route::get('/', array('uses' => 'ProductController@getIndex'));
	Route::get('av/{language?}', array('uses' => 'ProductController@tandc'));

	Route::controller('products', 'ProductController');

	Route::post('contact', array('uses' => 'HomeController@doContact'));

	Route::controller('orders', 'OrderController');

	Route::get('login/{intended?}', array('uses' => 'LoginController@showLogin'));
	Route::get('aff/{affiliate?}', array('uses' => 'OrderController@getAffiliate'));
	Route::post('login', array('uses' => 'LoginController@doLogin'));
	Route::get('logout', array('uses' => 'LoginController@doLogout'));

	Route::get('pay/{order}', array('uses' => 'OrderController@pay'));
	Route::get('complete/{order}', array('uses' => 'OrderController@complete'));
	Route::post('complete_creditcard/{order}', array('uses' => 'OrderController@stripe_save'));

	Route::get('home', function()
	{
		$users = User::all();

	    return View::make('home')->with('users', $users);
	});

	Route::get('user/{id}', 'UserController@showProfile');


	Route::resource('signup', 'SignupController');
});
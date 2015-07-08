<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');



// UI Stubs
Route::get('about', function()
{
    return view('about');
});

Route::get('contact', function()
{
    return view('contact', [
        'title' => 'Reach out to us',
        'subtitle' => 'To view more products, place an order or get price details, please reach out to us.',
        'showMap'  => true
    ]);
});
Route::get('more', function()
{
    return view('contact', [
        'title' => 'Need more products?',
        'subtitle' => 'To view more products, place an order or get price details, please reach out to us.',
        'showMap'  => false
    ]);
});




Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('products', 'ProductsController');
Route::resource('catalogues', 'CataloguesController');

Route::get('{access_key}', 'CataloguesController@showCatalogue');
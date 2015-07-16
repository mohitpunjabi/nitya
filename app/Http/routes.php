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

Route::group(['middleware' => 'auth'], function()
{
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

Route::get('sitemap', 'SitemapController@index');
Route::get('sitemap/submit', 'SitemapController@submit');


Route::get('/', 'WelcomeController@index');

Route::get('home', 'WelcomeController@index');

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

Route::get('products/search', 'ProductsController@search');
Route::resource('products', 'ProductsController');
Route::get('products/{products}/{slug}', 'ProductsController@show');

Route::post('catalogues/{catalogues}/add', 'CataloguesController@add');
Route::get('catalogues/{catalogues}/remove', 'CataloguesController@remove');
Route::resource('catalogues', 'CataloguesController');
Route::resource('enquiries', 'EnquiriesController');

Route::get('{access_key}', 'CataloguesController@showCatalogue');
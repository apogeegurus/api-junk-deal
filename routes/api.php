<?php

use Illuminate\Http\Request;

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

Route::post('get/quote', 'SiteController@getQuote');
Route::post('contact', 'SiteController@contact');
Route::get('info', 'SiteController@index');
Route::get('info/home/page', 'SiteController@indexHomePage');
Route::get('info/testimonials', 'SiteController@indexTestimonials');
Route::get('info/videos', 'SiteController@indexVideos');
Route::get('info/slider/images', 'SiteController@indexSlider');
Route::get('info/about', 'SiteController@indexAbout');
Route::get('services/names', 'ServiceController@indexNames');
Route::get('services/{slug}/show', 'ServiceController@show');
Route::get('locations/names', 'LocationController@indexNames');
Route::get('locations', 'LocationController@index');
Route::get('locations/{slug}/show', 'LocationController@show');

Route::get('blogs', 'BlogController@index');
Route::get('blogs/{slug}', 'BlogController@show');

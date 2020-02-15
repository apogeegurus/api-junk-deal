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
    return redirect()->route('home');
})->middleware('auth');

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false,
    'confirm' => false
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('home');
    Route::get('contact', 'DashboardController@contacts')->name('contact.index');
    Route::post('contact', 'DashboardController@contactReply')->name('contact.reply');
    Route::post('quotes', 'DashboardController@quoteReply')->name('quotes.reply');
    Route::delete('services/images/{id}', 'ServiceController@destroyImage');
    Route::resource('services', 'ServiceController');
    Route::resource('settings', 'SettingController');
    Route::resource('testimonials', 'TestimonialController');
    Route::resource('sliders', 'SliderController');

    Route::delete('locations/images/{id}/slider', 'LocationController@destroyImageSlider');
    Route::delete('locations/images/{id}/gallery', 'LocationController@destroyImageGallery');

    Route::get('locations/{location}/gallery', 'LocationController@galleryIndex')->name('locations.gallery');
    Route::get('locations/{location}/gallery/create', 'LocationController@galleryCreate')->name('locations.gallery.create');
    Route::post('locations/{location}/gallery', 'LocationController@galleryStore')->name('locations.gallery.store');

    Route::get('locations/{location}/slider', 'LocationController@sliderIndex')->name('locations.slider');
    Route::get('locations/{location}/slider/create', 'LocationController@sliderCreate')->name('locations.slider.create');
    Route::post('locations/{location}/slider', 'LocationController@sliderStore')->name('locations.slider.store');

    Route::resource('locations', 'LocationController');
    Route::resource('videos', 'VideoController');

    Route::resource('about', 'AboutController');
    Route::resource('teams', 'TeamController');
    Route::post('blogs/ckeditor/upload', 'BlogController@upload')->name('ckeditor.upload');
    Route::resource('blogs', 'BlogController');
});

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
    Route::get('quotes/export', 'DashboardController@exportQuotes')->name('quotes.export');
    Route::delete('quotes/{id}', 'DashboardController@quoteDelete')->name('quotes.delete');
    Route::delete('services/images/{id}', 'ServiceController@destroyImage');


    Route::post('services/order/change', 'ServiceController@orderChange');
    Route::post('services/order/change/gallery', 'ServiceController@orderChangeGallery');
    Route::get('services/{service}/slider', 'ServiceController@sliderIndex')->name('services.slider');
    Route::get('services/{service}/slider/create', 'ServiceController@sliderCreate')->name('services.slider.create');
    Route::post('services/{service}/slider', 'ServiceController@sliderStore')->name('services.slider.store');
    Route::get('services/slider/{slider}/edit', 'ServiceController@editSlider')->name('services.slider.edit');
    Route::put('services/slider/{slider}', 'ServiceController@updateSlider')->name('services.slider.update');

    Route::delete('services/images/{id}/slider', 'ServiceController@destroyImageSlider');


    Route::resource('services', 'ServiceController');

    Route::get('services/{service}/gallery', 'ServiceController@galleryIndex')->name('services.gallery');
    Route::get('services/{service}/gallery/create', 'ServiceController@galleryCreate')->name('services.gallery.create');
    Route::post('services/{service}/gallery', 'ServiceController@galleryStore')->name('services.gallery.store');
    Route::get('services/gallery/{gallery}/edit', 'ServiceController@galleryEdit')->name('services.gallery.edit');
    Route::put('services/gallery/{gallery}', 'ServiceController@galleryUpdate')->name('services.gallery.update');

    Route::resource('settings', 'SettingController');
    Route::resource('testimonials', 'TestimonialController');
    Route::post('sliders/order/change', 'SliderController@orderChange');
    Route::resource('sliders', 'SliderController');

    Route::delete('locations/images/{id}/slider', 'LocationController@destroyImageSlider');
    Route::delete('locations/images/{id}/gallery', 'LocationController@destroyImageGallery');

    Route::get('locations/{location}/gallery', 'LocationController@galleryIndex')->name('locations.gallery');
    Route::get('locations/{location}/gallery/create', 'LocationController@galleryCreate')->name('locations.gallery.create');
    Route::post('locations/{location}/gallery', 'LocationController@galleryStore')->name('locations.gallery.store');
    Route::get('locations/gallery/{gallery}/edit', 'LocationController@galleryEdit')->name('locations.gallery.edit');
    Route::put('locations/gallery/{gallery}', 'LocationController@galleryUpdate')->name('locations.gallery.update');

    Route::get('locations/{location}/slider', 'LocationController@sliderIndex')->name('locations.slider');
    Route::get('locations/{location}/slider/create', 'LocationController@sliderCreate')->name('locations.slider.create');
    Route::post('locations/{location}/slider', 'LocationController@sliderStore')->name('locations.slider.store');
    Route::get('locations/slider/{slider}/edit', 'LocationController@sliderEdit')->name('locations.slider.edit');
    Route::put('locations/slider/{slider}', 'LocationController@sliderUpdate')->name('locations.slider.update');

    Route::resource('locations', 'LocationController');
    Route::post('locations/order/change', 'LocationController@orderChange');
    Route::post('locations/order/change/slider', 'LocationController@orderChangeSlider');
    Route::resource('places', 'PlacesController');
    Route::resource('videos', 'VideoController');

    Route::resource('about', 'AboutController');
    Route::resource('teams', 'TeamController');
    Route::post('blogs/ckeditor/upload', 'BlogController@upload')->name('ckeditor.upload');
    Route::resource('blogs', 'BlogController');
    Route::resource('specializes', 'SpecializeController');
    Route::post('specializes/order/change', 'SpecializeController@orderChange');


    Route::get('backup', 'BackupController@index')->name('backup.index');
    Route::post('backup', 'BackupController@importBackup')->name('backup.change');
    Route::get('backup/now', 'BackupController@backupDB')->name('backup.db');
    Route::delete('backup/{file_name}', 'BackupController@removeBackup')->name('backup.remove');


    Route::get('pages/home', 'PageController@home')->name('pages.home');
    Route::put('pages/home/{id}', 'PageController@homeSave')->name('pages.home.update');

});

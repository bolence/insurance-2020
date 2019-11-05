<?php


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'vehicles', 'middleware' => 'auth'], function() {

    Route::get('/', 'VehicleController@index')->name('vehicles.list');

});


Route::get('damages', 'DamageController@index')->middleware('auth');

Route::group(['prefix' => 'reports', 'middleware' => 'auth'], function() {
    Route::get('/', 'PdfController@index');
    Route::get('pdf', 'PdfController@report')->name('generate-pdf');
    Route::get('pdf/damages', 'PdfController@report_damages')->name('generate-pdf-damage');
});

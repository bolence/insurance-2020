<?php


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'vehicles'], function() {

    Route::get('/', 'VehicleController@index')->name('vehicles.list');

});

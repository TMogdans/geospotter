<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/findNearby', 'LocationController@findNearby');
    Route::get('/findByZip/{zip}', 'LocationController@findByZip');
    Route::get('/findByName/{name}', 'LocationController@findByName');
});

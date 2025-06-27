<?php

use Vendor\GoogleAuth\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

Route::prefix('google')->controller(GoogleController::class)->group(function () {
    Route::get('/redirect', 'redirect')->name('google.redirect');
    Route::get('/callback', 'callback')->name('google.callback');
});

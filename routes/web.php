<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/help', function () {
    return view('help');
});

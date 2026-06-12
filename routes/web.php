<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/face', function () {
    return view('face');
})->name('face');

Route::get('/pic/{filename}', function ($filename) {
    $url = "http://10.40.3.41:8080/{$filename}.jpg";
    $response = Http::get($url);
    if (!$response->ok()) {
        abort(404);
    }
    return response($response->body())
        ->header('Content-Type', 'image/jpeg');
});


Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/help', function () {
    return view('help');
});

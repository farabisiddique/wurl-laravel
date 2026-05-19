<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;




Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

Route::post('/shorten', [HomeController::class, 'shorten'])->name('shorten');
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::post('/shorten', [HomeController::class, 'shorten'])->name('shorten');

// Must be last — catches all short-link slugs
Route::get('/{customText}', [RedirectController::class, 'handle'])->name('redirect');

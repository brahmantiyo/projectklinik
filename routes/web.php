<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('patients', App\Http\Controllers\PatientController::class);
Route::resource('polis', App\Http\Controllers\PoliController::class);
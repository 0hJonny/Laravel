<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController; 
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\CopyController;

Route::get('/', [PublicationController::class, 'index'])->name('welcome');

Route::resource('publications', PublicationController::class);
Route::resource('readers', ReaderController::class);
Route::resource('loans', LoanController::class);
Route::resource('copies', CopyController::class);

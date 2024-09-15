<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController; 
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\LoanController;

Route::get('/', [PublicationController::class, 'index'])->name('welcome');

Route::get('/publications', [PublicationController::class, 'index'])->name('publications.index');
Route::get('/publications/{id}', [PublicationController::class, 'show'])->name('publications.show');

Route::get('/readers', [ReaderController::class, 'index'])->name('readers.index');
Route::get('/readers/{id}', [ReaderController::class, 'show'])->name('readers.show');

Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
Route::get('/loans/{id}', [LoanController::class, 'show'])->name('loans.show');

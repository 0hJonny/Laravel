<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController; 
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LoginController;

Route::get('/', [PublicationController::class, 'index'])->name('welcome');

Route::resource('publications', PublicationController::class)->middleware('auth');
Route::resource('readers', ReaderController::class)->middleware('auth');
Route::resource('loans', LoanController::class)->middleware('auth');
Route::resource('copies', CopyController::class)->middleware('auth');
Route::post('/copies/storeDuplicate', [CopyController::class, 'storeDuplicate'])->name('copies.storeDuplicate')->middleware('auth');
Route::get('/copies/{id}/duplicate', [CopyController::class, 'duplicate'])->name('copies.duplicate')->middleware('auth');
Route::get('copies/{copy}/show', [CopyController::class, 'show'])->name('copies.show')->middleware('auth');

Route::post('/loans/storeDuplicate', [LoanController::class, 'storeDuplicate'])->name('loans.storeDuplicate')->middleware('auth');
Route::get('/loans/{id}/duplicate', [LoanController::class, 'duplicate'])->name('loans.duplicate')->middleware('auth');
Route::get('loans/{loan}/show', [LoanController::class, 'show'])->name('loans.show')->middleware('auth');
Route::get('loans/{loan}/copy', [LoanController::class, 'copy'])->name('loans.copy')->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

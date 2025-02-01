<?php

use Illuminate\Support\Facades\Route;
use App\Books\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Books\BookController::class,'build_table'])->name('build_table');
Route::get('/add/', [\App\Books\BookController::class,'build_editor'])->name('call_editor');
Route::get('/edit/{id}', [\App\Books\BookController::class,'build_editor'])->name('call_editor');
Route::post('/save/{id}', [\App\Books\BookController::class,'save']);
Route::get('/del/{id}', [\App\Books\BookController::class,'delete']);
Route::get('/images/{id}', [\App\Books\BookController::class,'show_cover'])->name('show_cover');
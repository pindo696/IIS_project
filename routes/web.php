<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group( function (){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
});

Route::middleware(['auth', 'volunteer'])->group( function (){
    Route::get('/volunteer', [App\Http\Controllers\VolunteerController::class, 'index'])->name('volunteer');
});

Route::middleware(['auth', 'vet'])->group( function (){
    Route::get('/vet', [App\Http\Controllers\VetController::class, 'index'])->name('vet');
});

Route::middleware(['auth', 'careman'])->group( function (){
    Route::get('/careman', [App\Http\Controllers\CaremanController::class, 'index'])->name('careman');
});

Auth::routes();



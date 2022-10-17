<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaremanController;
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

Route::get('/unauth', [App\Http\Controllers\VolunteerController::class, 'unauth'])->name('unauth');
Route::get('/support', [App\Http\Controllers\VolunteerController::class, 'support'])->name('support');

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
    Route::get('/careman/requests', [App\Http\Controllers\CaremanController::class, 'index'])->name('careman');
    Route::get('/careman/animals', [App\Http\Controllers\CaremanController::class, 'pets'])->name('pets');
    Route::get('/careman/animals/addpet', [App\Http\Controllers\CaremanController::class, 'addpet'])->name('addpet');
    //Route::resource('/careman/requests', CaremanController::class);
    Route::post('/careman/acceptVolunteer', [App\Http\Controllers\CaremanController::class, 'acceptVolunteer']);
    Route::post('/careman/declineVolunteer', [App\Http\Controllers\CaremanController::class, 'declineVolunteer']);
    Route::post('/careman/banVolunteer', [App\Http\Controllers\CaremanController::class, 'banVolunteer']);
    Route::post('/careman/deleteVolunteer', [App\Http\Controllers\CaremanController::class, 'deleteVolunteer']);
});

Auth::routes();



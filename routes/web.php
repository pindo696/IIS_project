<?php

use App\Models\Animal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CaremanController;
use App\Http\Controllers\VetController;
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

/**
 * Represents web routes
 */

Route::get('/', [AnimalController::class, 'index']);

Route::get('/about', [Controller::class, 'about']);

Route::get('/unauth', [App\Http\Controllers\VolunteerController::class, 'unauth'])->name('unauth');
Route::get('/support', [App\Http\Controllers\VolunteerController::class, 'support'])->name('support');

Route::middleware(['auth', 'admin'])->group( function (){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/animals', [App\Http\Controllers\AdminController::class, 'show_animals'])->name('admin');
    Route::put('/admin/create/user', [App\Http\Controllers\AdminController::class, 'create_user'])->name('admin');
    Route::put('/admin/remove/user', [App\Http\Controllers\AdminController::class, 'remove_user'])->name('admin');
    Route::put('/admin/manage/user', [App\Http\Controllers\AdminController::class, 'manage_user'])->name('admin');
    Route::put('/admin/create/animal', [App\Http\Controllers\AdminController::class, 'create_animal'])->name('admin');
    Route::put('/admin/remove/animal', [App\Http\Controllers\AdminController::class, 'remove_animal'])->name('admin');
    Route::put('/admin/manage/animal', [App\Http\Controllers\AdminController::class, 'manage_animal'])->name('admin');
});

Route::middleware(['auth', 'volunteer'])->group( function (){
    Route::get('/volunteer', [App\Http\Controllers\VolunteerController::class, 'index'])->name('volunteer');
    Route::any('/volunteer/history', [App\Http\Controllers\VolunteerController::class, 'getVolunteerHistory']);
    Route::any('/volunteer/pet-detail', [App\Http\Controllers\VolunteerController::class, 'petDetail']);
    Route::any('/volunteer/pet-schedule', [App\Http\Controllers\VolunteerController::class, 'petSchedule']);
    Route::any('/volunteer/pet-schedule-volunteer', [App\Http\Controllers\VolunteerController::class, 'showPetSchedule']);
    Route::post('/volunteer/bookTermin', [App\Http\Controllers\VolunteerController::class, 'bookTermin']);
    Route::post('/volunteer/cancelTermin', [App\Http\Controllers\VolunteerController::class, 'cancelTermin']);

});
Route::middleware(['auth', 'vet'])->group( function (){
    Route::get('/vet', [VetController::class, 'getPetExaminationsAndRecords'])->name('vet');
    Route::put('/vet/request/savechange', [VetController::class, 'editExam'])->name('vet');
    Route::put('/vet/record/savechange', [VetController::class, 'editExam2'])->name('vet');
    Route::put('/vet/record/remove', [VetController::class, 'removeExam'])->name('vet');
    Route::put('/vet/record/create', [VetController::class, 'createExam'])->name('vet');
    Route::get('/vet/records/animal/{id}', [VetController::class, 'getAnimalRecordsDetailed'])->name('vet');

    Route::post('/vet/request/{id}', [VetController::class, 'getRequestDetailed'])->name('vet');
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
    Route::post('/careman/animals/addpet/add', [App\Http\Controllers\AnimalController::class, 'addPet']);
    Route::any('/careman/animals/pet-detail', [App\Http\Controllers\AnimalController::class, 'showPetDetail']);
    Route::any('/careman/animals/pet-edit', [App\Http\Controllers\AnimalController::class, 'showPetEdit']);
    Route::any('/careman/animals/pet-schedule', [App\Http\Controllers\AnimalController::class, 'showPetDetail']);
    Route::post('/careman/animals/pet-edit/edit', [App\Http\Controllers\AnimalController::class, 'editPet']);
    Route::post('/careman/animals/pet-edit/delete', [App\Http\Controllers\AnimalController::class, 'deletePet']);
    Route::any('/careman/animals/pet-detail/examinations', [App\Http\Controllers\AnimalController::class, 'animalExaminations']);
    Route::any('/careman/animals/request-examination', [App\Http\Controllers\ExaminationController::class, 'requestExamination']);
    Route::any('/careman/animals/pet-edit/request-examination/send', [App\Http\Controllers\ExaminationController::class, 'createExamination']);
    Route::any('/careman/examination/examination-request/delete', [App\Http\Controllers\ExaminationController::class, 'deleteRequest']);
    Route::post('/careman/declineWalk', [App\Http\Controllers\ReservationController::class, 'declineWalk']);
    Route::post('/careman/acceptWalk', [App\Http\Controllers\ReservationController::class, 'acceptWalk']);
    Route::any('/careman/animals/pet-schedule', [App\Http\Controllers\AnimalController::class, 'petSchedule']);
    Route::any('/careman/deleteWalk', [App\Http\Controllers\ReservationController::class, 'deleteWalk']);
    Route::any('/careman/animals/createScheduleItem', [App\Http\Controllers\ReservationController::class, 'showCreateScheduleItemForm']);
    Route::post('/careman/animals/createScheduleItem/add', [App\Http\Controllers\ReservationController::class, 'crateScheduleItem']);
    Route::post('/careman/pickupAnimal', [App\Http\Controllers\ReservationController::class, 'pickupAnimal']);
    Route::post('/careman/returnAnimal', [App\Http\Controllers\ReservationController::class, 'returnAnimal']);
    Route::post('/careman/declineWalk/fromMain', [App\Http\Controllers\ReservationController::class, 'declineWalkFromMain']);
    Route::post('/careman/acceptWalk/fromMain', [App\Http\Controllers\ReservationController::class, 'acceptWalkFromMain']);

});
// Single pet simple detail
Route::get('/animal/{id}', [AnimalController::class, 'show']);
Auth::routes();



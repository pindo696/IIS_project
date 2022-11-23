<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalController{

    /**
     * Andrej Luptak (xlupta05)
     * except index and show methods
     * Controller represents actions concerning animal and operations
     */

    /**
     * controller function for adding animals
     * on error, return to formular with previously data input
     * prepares date
     * call Model part to insert pet
     */
    public function addPet(Request $request){
        $date = Carbon::parse($request->discoveryDate);
        if(!($date->isPast())){
            return redirect()->back()
                ->with('dateError', true)
                ->with('animal_name', $request->input('name'))
                ->with('species', $request->input('species'))
                ->with('color', $request->input('color'))
                ->with('animal_age', $request->input('age'))
                ->with('discoveryPlace', $request->input('discoveryPlace'))
                ->with('animal_description', $request->input('description'))
                ->with('message','Date is in the future');

        }else{
            $request['discoveryDate'] = $date->format('Y-m-d');
            app()->call('App\Models\Animal@db_addPet', ['request'=> $request]);
            return redirect("/careman/animals")->with('success', true)->with('message', 'Pet was successfully added');
        }
    }

    // Show all pets
    public function index() {
        return view('list_animals', ['animals' => Animal::latest()->filter(request(['search']))->paginate(9)]);
    }

    //Show single pet
    public function show($id) {
        $animal = Animal::getbyid($id);
        return view('pet_simple_detail', [
            'animal' => $animal
        ]);
    }

    /**
     * Calls Model to obtain data
     * @return array all pets loaded from DB.
     */
    public function getAllPets() : array{
        return app()->call('App\Models\Animal@db_getAllPets');
    }

    /**
     * @param $id animal id to be searched for
     * @return array as DB result with NULL if animal was not found or array of animal attributes
     */
    public function getPetExaminations($id) : array{
        return app()->call('App\Models\Animal@db_getPetExaminations', ['id' => $id]);;
    }

    /**
     * gets pet informations
     * @param $id animal to be searched for
     * @return array of animal attributes, NULL if animal was not found
     */
    public function getPetDetail($id) : array{
        return app()->call('App\Models\Animal@db_getPetDetail', ['id' => $id]);
    }

    /**
     * shows page with animal information
     * @param Request $request
     * @return view displaying pet details
     */
    public function showPetDetail(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-detail', compact('result', 'result'));
    }

    /**
     * show page for pet editing
     * @param Request $request
     * @return view for pet editing
     */
    public function showPetEdit(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-edit', compact('result', 'result'));
    }

    /**
     * parses, checks and prepares data from formular.
     * If data ok, call Model part for editing pet in DB
     * IF data not ok, redirect back to formular with error message
     * @param Request $request
     * @return view back to main animal page
     */
    public function editPet(Request $request){
        $date = Carbon::parse($request->discoveryDate);
        if(!($date->isPast())){
            return redirect()->back()
                ->with('dateError', true)
                ->with('animal_name', $request->input('name'))
                ->with('species', $request->input('species'))
                ->with('color', $request->input('color'))
                ->with('animal_age', $request->input('age'))
                ->with('discoveryPlace', $request->input('discoveryPlace'))
                ->with('animal_description', $request->input('description'))
                ->with('message','Date is in the future');

        }else{
            if(!$request->isMethod('post')) return redirect('/careman/animals');
            app()->call('App\Models\Animal@db_editPet', ['request' => $request ,'date' => $date]);
            return redirect("/careman/animals")->with('success', true)->with('message', 'Pet was successfully edited');
        }
    }

    /**
     * calls Model part for deleting animal
     * @param Request $request
     * @return - animals page
     * On success with warning message (warning because deletion was performed)
     * On error with error message
     */
    public function deletePet(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $n_rows = app()->call('App\Models\Animal@db_deletePet');
        if($n_rows == 1){
            return redirect("/careman/animals")->with('warning', true)->with('message', 'Pet was successfully deleted');
        }elseif($n_rows >= 2){
            return redirect("/careman/animals")->with('error', true)->with('message', 'Multiple pets were deleted');
        }else{
            return redirect("/careman/animals")->with('error', true)->with('message', 'Deleting animal unsuccessful');
        }
    }

    /**
     * gets pet examinations from Model part, using one of Controller methods
     * @param Request $request
     * @return - pet examination view with examinations
     */
    public function animalExaminations(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Http\Controllers\AnimalController@getPetExaminations', ['id' => $request->animal_id]);
        return view('pet-examinations', compact('result', 'result'));
    }

    /**
     * calls Model part method and displays result as pet shedule data
     * @param Request $request
     * @return - pet schedule view
     */
    public function petSchedule(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Models\Reservation@db_getPetReservations', ['id' => $request->animal_id]);
        return view('pet-schedule', compact('result', 'result'));
    }

}


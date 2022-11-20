<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalController{

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
        return view('list_animals', ['animals' => Animal::latest()->paginate(9)]);
    }

    //Show single pet
    public function show($id) {
        $animal = Animal::getbyid($id);
        return view('pet_simple_detail', [
            'animal' => $animal
        ]);
    }

    public function getAllPets() : array{
        return app()->call('App\Models\Animal@db_getAllPets');
    }

    public function getPetExaminations($id) : array{
        return app()->call('App\Models\Animal@db_getPetExaminations', ['id' => $id]);;
    }

    public function getPetDetail($id) : array{
        return app()->call('App\Models\Animal@db_getPetDetail', ['id' => $id]);
    }

    public function showPetDetail(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-detail', compact('result', 'result'));
    }

    public function showPetEdit(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Http\Controllers\AnimalController@getPetDetail',['id' => $request]);
        return view('pet-edit', compact('result', 'result'));
    }

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

    public function deletePet(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $n_rows = app()->call('App\Models\Animal@db_deletePet');
        if($n_rows > 0){
            return redirect("/careman/animals")->with('success', true)->with('message', 'Pet was successfully deleted');
        }else{
            return redirect("/careman/animals")->with('error', true)->with('message', 'Deleting animal unsuccessful');
        }
    }

    public function animalExaminations(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Http\Controllers\AnimalController@getPetExaminations', ['id' => $request->animal_id]);
        return view('pet-examinations', compact('result', 'result'));
    }

    public function petSchedule(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Models\Reservation@db_getPetReservations', ['id' => $request->animal_id]);
        return view('pet-schedule', compact('result', 'result'));
    }

}


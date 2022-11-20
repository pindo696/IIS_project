<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class VetController{
    public function index(){
        return view('vet');
    }

    public function getPetExaminationsAndRecords(){
        return view('vet', app()->call('App\Models\Examination@db_getAllPetExaminationsAndRecords'));
    }

    public function getRequestDetailed($id){
        return view('vet_request', app()->call('App\Models\Examination@db_getPetExaminationById', ['id' => $id]));
    
    }

    public function getAnimalRecordDetailed($id){
        return view('vet_animal_record', app()->call('App\Models\Medical_Records@db_getAnimalRecordDetailed', ['id' => $id]));
    }
    
}

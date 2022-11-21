<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class VetController{
    public function index(){
        return view('vet');
    }
    public function editExam(Request $request){
        if(!$request->isMethod('put')) return redirect('/vet');
        app()->call('App\Models\Examination@db_updateExamination', ['request' => $request]);
        return redirect("/vet")->with('success', true)->with('message', 'Successfully managed examination request of type' . $request->examination_t . '!');
    }

    public function editExam2(Request $request){
        if(!$request->isMethod('put')) return redirect('/vet');
        app()->call('App\Models\Examination@db_updateExamination2', ['request' => $request]);
        return redirect()->back()->with('success', true)->with('message', 'Successfully saved changes!');
    }

    public function getPetExaminationsAndRecords(){
        return view('vet', app()->call('App\Models\Examination@db_getAllPetExaminationsAndRecords'));
    }

    public function getRequestDetailed($id){
        return view('vet_request', app()->call('App\Models\Examination@db_getPetExaminationById', ['id' => $id]));
    
    }

    public function getAnimalRecordsDetailed($id){
        return view('vet_animal_record', app()->call('App\Models\Examination@db_getAnimalRecordsDetailed', ['id' => $id]));
    }
    
}

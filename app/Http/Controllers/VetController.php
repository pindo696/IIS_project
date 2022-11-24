<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
    public function removeExam(Request $request){
        if(!$request->isMethod('put')) return redirect('/vet');
        app()->call('App\Models\Examination@db_removeExamination', ['request' => $request]);
        return redirect()->back()->with('success', true)->with('message', 'Successfully removed record!');
    }
    public function createExam(Request $request){
        if(!$request->isMethod('put')) return redirect('/vet');
        //if(Carbon::parse($request->examination_fr)->gt(Carbon::parse($request->examination_to))){
        //   return redirect("/vet")->with('dateError', true);
        //}
        app()->call('App\Models\Examination@db_createExaminationRaw', ['request' => $request]);
        return redirect()->back()->with('success', true)->with('message', 'Successfully created record!');
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

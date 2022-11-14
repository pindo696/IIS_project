<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ExaminationController extends Controller
{
    public function getAllPetExaminations(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = DB::select("SELECT * FROM examinations");
        //TODO return view of examination detail
    }

    public function getPetExaminationByPetId($id){
        $result = DB::select("SELECT * FROM examinations WHERE fk_animal_id LIKE :id", ['id' => $id]);
    }

    public function requestExamination(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = $request;
        return view('request-examination', compact('result', 'result'));
    }

    public function createExamination(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        if($request->examinationType != 'Choose...'){
            $examination = Examination::create([
                'fk_animal_id' => $request->input('animal_id'),
                'fk_requested_by_careman_id' => $request->input('careman_id'),
                'examination_status' => 'requested',
                'examination_type' => $request->input('examinationType'),
                'examination_description' => $request->input('examinationDescription'),
            ]);
            return redirect("/careman/animals")->with('success', true)->with('message', 'Examination request for animal ' . $request->animal_name . ' was created.');
        }else{
            return redirect("/careman/animals")->with('error', true)->with('message', 'Examination request for animal ' . $request->animal_name . ' was dismissed. Check whether examination type was selected.');
        }
    }

}
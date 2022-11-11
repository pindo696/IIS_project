<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationController extends Controller
{
    public function getAllPetExaminations(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = DB::select("SELECT * FROM examinations");
    }

    public function getPetExaminationByPetId($id){
        $result = DB::select("SELECT * FROM examinations WHERE fk_animal_id LIKE :id", ['id' => $id]);
    }

    public function requestExamination(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = $request;
        return view('request-examination', compact('result', 'result'));
    }

}

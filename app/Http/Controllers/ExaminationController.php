<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Examination;
use App\Http\Controllers\AnimalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExaminationController extends Controller
{
    /**
     * Andrej Luptak (xlupta05)
     * Controller implements actions associated with examinations and requests
     * Implements all examination actions
     */


    /**
     * calls Model part to display all pet examinations based on animal id
     * @param Request $request
     * @return - view of single pet examinations
     */
    public function getAllPetExaminations(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = app()->call('App\Models\ControllersExaminations@db_getPetExaminations');
        return view('pet-examination-detail', compact('result', 'result'));
    }

    /**
     * calls Model part to delete created request
     * @param Request $request
     * @return - view back to pet examinations
     */
    public function deleteRequest(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        app()->call('App\Models\Examination@db_deleteRequest');
        $result = app()->call('App\Models\Animal@db_getPetExaminations', ['id' => $request->animal_id]);
        return view('pet-examinations', compact('result', 'result'));
    }

    /**
     * Method to display formular for requesting examinations
     * @param Request $request
     * @return - view with formular
     */
    public function requestExamination(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        $result = $request;
        return view('request-examination', compact('result', 'result'));
    }

    /**
     * process passed data in fromular and calls Model part for inserting examination in DB
     * @param Request $request
     * @return - animals view
     */
    public function createExamination(Request $request){
        if(!$request->isMethod('post')) return redirect('/careman/animals');
        if($request->examinationType != 'Choose...'){
            app()->call('App\Models\Examination@db_createExamination', ['request' => $request]);
            return redirect("/careman/animals")->with('success', true)->with('message', 'Examination request for animal ' . $request->animal_name . ' was created.');
        }else{
            return redirect("/careman/animals")->with('error', true)->with('message', 'Examination request for animal ' . $request->animal_name . ' was dismissed. Check whether examination type was selected.');
        }
    }

}

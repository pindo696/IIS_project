<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = ['fk_animal_id', 'fk_requested_by_careman_id', 'fk_vet_id', 'examination_status', 'examination_type', 'examination_description', 'examination_from', 'examination_to'];

    public function db_getAllPetExaminations(Request $request){
        return DB::select("SELECT * FROM examinations WHERE examination_id LIKE :id ", ['id' => $request->examination_id]);
    }

    public function db_getPetExaminationByPetId($id){
        return DB::select("SELECT * FROM examinations WHERE fk_animal_id LIKE :id", ['id' => $id]);
    }

    public function db_deleteRequest(Request $request){
        return DB::select("DELETE FROM examinations WHERE examination_id LIKE :id", ['id' => $request->examination_id]);
    }

    public function db_createExamination(Request $request){
        $examination = Examination::create([
            'fk_animal_id' => $request->input('animal_id'),
            'fk_requested_by_careman_id' => $request->input('careman_id'),
            'examination_status' => 'requested',
            'examination_type' => $request->input('examinationType'),
            'examination_description' => $request->input('examinationDescription'),
        ]);
    }

}

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

    public function db_getAllPetExaminationsAndRecords(){
        $examinations= DB::select("SELECT * FROM examinations JOIN users ON examinations.fk_requested_by_careman_id = users.id JOIN animals ON examinations.fk_animal_id=animals.animal_id");
        $records = DB::select("SELECT * FROM animals");
        return [
            'examinations' =>$examinations,
            'records' => $records
        ];
    }

    
    public function db_getAnimalRecordsDetailed($id){
        $records = DB::select("SELECT * FROM examinations JOIN animals ON examinations.fk_animal_id=animals.animal_id JOIN users ON examinations.fk_vet_id=users.id WHERE fk_animal_id=$id");
        return [
            'records' => $records
        ];
    }

    public function db_getAllPetExaminations(Request $request){
        return DB::select("SELECT * FROM examinations WHERE examination_id LIKE :id ", ['id' => $request->examination_id]);
    }

    public function db_getPetExaminationById($id){
        $examination = DB::select("SELECT * FROM examinations JOIN animals ON examinations.fk_animal_id=animals.animal_id WHERE examination_id=$id");
        return [
            'examination' => $examination
        ];
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

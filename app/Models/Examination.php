<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Examination extends Model
{
    use HasFactory;

    /**
     * Andrej Luptak (xlupta05)
     * Model part implements DB operations
     * Implements DB operations against examination table
     */

    /**
     * @var string[] - attributes, which can be modified in DB
     */
    protected $fillable = ['fk_animal_id', 'fk_requested_by_careman_id', 'fk_vet_id', 'examination_status', 'examination_type', 'examination_description', 'vet_examination_notes', 'examination_from', 'examination_to', 'fk_approved_by_id'];

    /**
     * Gets all examinations based on animal id
     * @return array as DB query result
     */
    public function db_getAllPetExaminationsAndRecords(){
        $examinations= DB::select("SELECT * FROM examinations JOIN users ON examinations.fk_requested_by_careman_id = users.id JOIN animals ON examinations.fk_animal_id=animals.animal_id ORDER BY examinations.examination_from DESC");
        $records = DB::select("SELECT * FROM animals");
        return [
            'examinations' =>$examinations,
            'records' => $records
        ];
    }

    /**
     * Gets animal information - including information about animal and its examinations
     * @param $id of animal
     * @return array as DB result
     */
    public function db_getAnimalRecordsDetailed($id){
        $records = DB::select("SELECT * FROM examinations JOIN animals ON examinations.fk_animal_id=animals.animal_id JOIN users ON examinations.fk_vet_id=users.id WHERE fk_animal_id=$id");
        $pets = DB::select("SELECT * FROM animals WHERE animal_id=$id");
        return [
            'records' => $records,
            'pets' => $pets
        ];
    }

    /**
     * Gets all pet examinations by pet id
     * @param Request $request
     * @return array
     */
    public function db_getAllPetExaminations(Request $request){
        return DB::select("SELECT * FROM examinations WHERE examination_id LIKE :id ", ['id' => $request->examination_id]);
    }

    /**
     * Get pet examinations joined with animal info
     * @param $id of animal
     * @return array
     */
    public function db_getPetExaminationById($id){
        $examination = DB::select("SELECT * FROM examinations JOIN animals ON examinations.fk_animal_id=animals.animal_id WHERE examination_id=$id");
        return [
            'examination' => $examination
        ];
    }

    /**
     * Delete created examination request
     * @param Request $request
     * @return array
     */
    public function db_deleteRequest(Request $request){
        return DB::select("DELETE FROM examinations WHERE examination_id LIKE :id", ['id' => $request->examination_id]);
    }

    /**
     * Insert created examination into DB from careman
     * @param Request $request
     * @return void
     */
    public function db_createExamination(Request $request){
        $examination = Examination::create([
            'fk_animal_id' => $request->input('animal_id'),
            'fk_requested_by_careman_id' => $request->input('careman_id'),
            'examination_status' => 'requested',
            'examination_type' => $request->input('examinationType'),
            'examination_description' => $request->input('examinationDescription'),
        ]);
    }

    /**
     * same but from vet
     * @param Request $request
     * @return void
     */
    public function db_createExaminationRaw(Request $request){
        $examination = Examination::create([
            'fk_animal_id' => $request->input('animal_id'),
            'fk_vet_id' => $request->input('doctorID'),
            'fk_requested_by_careman_id' => $request->input('doctorID'),
            'examination_status' => $request->input('status'),
            'examination_type' => $request->input('examination_t'),
            'examination_from' => $request->input('examination_fr'),
            'examination_to' => $request->input('examination_to'),
            'vet_examination_notes' => $request->input('vet_examination_notes'),
        ]);
    }

    /**
     * Update examination
     * @param Request $request
     * @return void
     */
    public function db_updateExamination(Request $request){
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $examination = DB::table('examinations')
            -> where('examination_id', $request->request_id)
            -> update([
                'examination_type' => $request->input('examination_t'),
                'examination_description' => $request->input('examination_desc'),
                'vet_examination_notes' => $request->input('vet_examination_notes'),
                'examination_from' => $request->input('examination_fr'),
                'examination_to' => $request->input('examination_to'),
                'updated_at' => $current_date_time,
                'examination_status' => $request->input('status'),
                'fk_vet_id' => $request->input('vet_id'),
            ]);

    }

    public function db_updateExamination2(Request $request){
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        $examination = DB::table('examinations')
            -> where('examination_id', $request->request_id)
            -> update([
                'examination_type' => $request->input('examination_t'),
                'vet_examination_notes' => $request->input('vet_examination_notes'),
                'examination_from' => $request->input('examination_fr'),
                'examination_to' => $request->input('examination_to'),
                'updated_at' => $current_date_time,
                'examination_status' => $request->input('status'),
            ]);

    }

    /**
     * remove examination from DB
     * @param Request $request
     * @return void
     */
    public function db_removeExamination(Request $request){
        $examination = DB::table('examinations')
            -> where('examination_id', $request->req_id)
            -> delete();

    }

}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Volunteer extends Model
{
    use HasFactory;

    public function db_getVolunteerHistory($id){
        $actual_date = Carbon::now();
        $result['upcomming'] = DB::select("SELECT * FROM reservations
                    RIGHT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                    WHERE reservations.fk_taken_by_volunteer_id LIKE :id
                    AND reservations.reservation_status NOT LIKE 'listed'
                    AND reservations.reservation_from > :date", ['id' => $id, 'date'=>$actual_date]);
        $result['past'] = DB::select("SELECT * FROM reservations
                    RIGHT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                    WHERE reservations.fk_taken_by_volunteer_id LIKE :id
                    AND reservations.reservation_status NOT LIKE 'listed'
                    AND reservations.reservation_from <= :date", ['id' => $id, 'date'=>$actual_date]);
        return $result;
    }

    public function db_getPetScheduleByVolunteerIDAndAnimalID($animal_id, $volunteer_id){
        $actual_date = Carbon::now();
        $result['listed'] = DB::select("SELECT * FROM reservations
                        JOIN animals ON animals.animal_id = reservations.fk_animal_id
                        WHERE fk_animal_id LIKE :animal_id
                        AND reservations.reservation_from > :date
                        AND reservations.reservation_status LIKE 'listed'", ['date' => $actual_date, 'animal_id' => $animal_id]);
        $result['taken'] = DB::select("SELECT * FROM reservations
                        WHERE fk_taken_by_volunteer_id LIKE :user_id
                        AND reservations.reservation_from > :date", ['date' => $actual_date,'user_id' => $volunteer_id]);
        return $result;
    }

}

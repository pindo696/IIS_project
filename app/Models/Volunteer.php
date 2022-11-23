<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Volunteer extends Model
{
    use HasFactory;

    /**
     * Andrej Luptak (xlupta05)
     * Model part implements DB operations
     * Implements DB operations against volunteer table
     */


    /**
     * Get volunteer requests and walk history
     * @param $id - as volunteer id
     * @return array - as DB result
     */
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

    /**
     * Joins animal reservations with animal information to display listed schedule items and taken
     * items by specific volunteer
     * @param $animal_id
     * @param $volunteer_id
     * @return array - as DB result
     * 'listed' - all listed, but not taken reservations
     * 'taken' - all taken reservations by provided volunteer_id
     */
    public function db_getPetScheduleByVolunteerIDAndAnimalID($animal_id, $volunteer_id){
        $actual_date = Carbon::now();
        $result['listed'] = DB::select("SELECT * FROM reservations
                        JOIN animals ON animals.animal_id = reservations.fk_animal_id
                        WHERE fk_animal_id LIKE :animal_id
                        AND reservations.reservation_from > :date
                        AND reservations.reservation_status LIKE 'listed'", ['date' => $actual_date, 'animal_id' => $animal_id]);
        $result['taken'] = DB::select("SELECT * FROM reservations
                        LEFT JOIN animals ON animals.animal_id = reservations.fk_animal_id
                        WHERE fk_taken_by_volunteer_id LIKE :user_id
                        AND reservations.fk_animal_id LIKE :animal_id
                        AND reservations.reservation_from > :date", ['date' => $actual_date,'user_id' => $volunteer_id, 'animal_id' => $animal_id]);
        return $result;
    }

    /**
     * processes book request by volunteer
     * @param $reservation_id
     * @param $volunteer_id
     * @return int
     */
    public function db_bookTermin($reservation_id, $volunteer_id){
        $result = DB::table('reservations')
            ->where('reservation_id', $reservation_id)
            ->update([
                'fk_taken_by_volunteer_id' => $volunteer_id,
                'reservation_status' => 'requested',
                ]);
        return $result;
    }

    /**
     * release booked termin
     * @param $reservation_id
     * @return int
     */
    public function db_releaseTermin($reservation_id){
        $result = DB::table('reservations')
            ->where('reservation_id', $reservation_id)
            ->update([
                'reservation_status' => 'listed',
                'fk_taken_by_volunteer_id' => null
            ]);
        return $result;
    }

}

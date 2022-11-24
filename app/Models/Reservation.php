<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Reservation extends Model{
    use HasFactory;

    /**
     * Andrej Luptak (xlupta05)
     * Model part implements DB operations
     * Implements DB operations against reservations table
     */

    /**
     * @var string[] - attributes, which can be modified in DB
     */

    protected $fillable = ['fk_animal_id', 'reservation_from', 'reservation_to', 'timestamp'];

    /**
     * Gets all reservations from DB
     * @return array as DB result
     */
    public function db_getAllReservations(){
        return DB::select('SELECT * FROM reservations');
    }

    /**
     * Create new reservation for animal
     * @param $animal_id
     * @param $start
     * @param $end
     * @return NULL if operation was not success
     */
    public function db_createReservationItem($animal_id, $start, $end){
        $reservation = Reservation::create([
            'fk_animal_id' => $animal_id,
            'reservation_from' => $start,
            'reservation_to' => $end,
        ]);
        return $reservation;
    }

    /**
     * get requested upcoming reservations of all animals
     * @return array
     */
    public function db_getAllReservationsJoinAnimalsJoinUsers(){
        $actual_date = Carbon::now();
        // shows upcomming REQUESTED pet schedules
        $result['upcomming'] = DB::select("SELECT reservations.reservation_id, reservations.reservation_from, reservations.reservation_to, animals.animal_id, animals.animal_name, users.name, users.surname
                            FROM reservations
                            LEFT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                            LEFT JOIN users ON reservations.fk_taken_by_volunteer_id = users.id
                            WHERE reservations.reservation_status LIKE 'requested'
                            AND reservations.reservation_from > :date ORDER BY reservation_from DESC", ['date' => $actual_date]);
        // shows past pet schedule
        $result['past'] = DB::select("SELECT reservations.reservation_id, reservations.reservation_from, reservations.reservation_to, animals.animal_id, animals.animal_name, users.name, users.surname
                            FROM reservations
                            LEFT JOIN animals ON reservations.fk_animal_id = animals.animal_id
                            LEFT JOIN users ON reservations.fk_taken_by_volunteer_id = users.id
                            WHERE reservations.reservation_from <= :date
                            AND reservations.reservation_status LIKE 'listed'
                            LIMIT 6", ['date' => $actual_date]);
        return $result;
    }

    /**
     * Declines walk request
     * @param $userID
     * @param $id as walk id
     * @return void
     */
    public function db_declineWalk($userID, $id){
        DB::table('reservations')->where('reservation_id', $id)->update(array('reservation_status'=>'declined'));
        DB::table('reservations')->where('reservation_id', $id)->update(array('fk_approved_by_id' => $userID));
    }

    /**
     * Accepts walk request
     * @param $userID
     * @param $id as request id
     * @return void
     */
    public function db_acceptWalk($userID, $id){
        DB::table('reservations')->where('reservation_id', $id)->update(array('reservation_status'=>'approved'));
        DB::table('reservations')->where('reservation_id', $id)->update(array('fk_approved_by_id' => $userID));
    }

    /**
     * Get pet upcoming and past reservations
     * @param $id
     * @return array
     */
    public function db_getPetReservations($id){
        $actual_date = Carbon::now();
        $result['past']= DB::select("SELECT reservations.reservation_id, reservations.reservation_status, reservations.reservation_from, reservations.reservation_to, users.name, users.surname FROM reservations
                            LEFT JOIN users ON users.id = reservations.fk_taken_by_volunteer_id
                            WHERE reservations.reservation_status LIKE 'returned'
                            OR reservations.reservation_from <= :date
                            AND reservations.reservation_status NOT LIKE 'pickedup'
                            AND fk_animal_id LIKE :id", ['date'=> $actual_date, 'id' => $id]);
        $result['upcomming']= DB::select("SELECT reservations.reservation_id, reservations.reservation_status, reservations.reservation_from, reservations.reservation_to, users.name, users.surname FROM reservations
                            LEFT JOIN users ON users.id = reservations.fk_taken_by_volunteer_id
                            WHERE reservations.reservation_from >= :date AND fk_animal_id LIKE :id
                            AND reservations.reservation_status NOT LIKE 'returned'
                            OR reservations.reservation_status LIKE 'pickedup'", ['date'=> $actual_date, 'id' => $id]);
        $result['animal'] = $id;
        return $result;
    }

    /**
     * Deletes reservation
     * @param $reservation_id
     * @return int
     */
    public function db_deleteWalk($reservation_id){
        return DB::table('reservations')->where('reservation_id', $reservation_id)->delete();
    }

    /**
     * Handles marking pet as pickedup by setting its attribute
     * @param $reservation_id
     * @return void
     */
    public function db_pickupAnimal($reservation_id){
        DB::table('reservations')->where('reservation_id', $reservation_id)->update(array('reservation_status' => 'pickedup'));
    }

    /**
     * Handles marking pet as returned by setting its attribute
     * @param $reservation_id
     * @return void
     */
    public function db_returnAnimal($reservation_id){
        DB::table('reservations')->where('reservation_id', $reservation_id)->update(array('reservation_status' => 'returned'));
    }

}

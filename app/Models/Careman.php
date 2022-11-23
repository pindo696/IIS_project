<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Careman extends Model
{
    use HasFactory;

    /**
     * Andrej Luptak (xlupta05)
     * Model part implements DB operations
     * Implements DB operations against careman table
     */

    /** careman uses users table
     *  differentiated by role
     */
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
    * careman works with users table
    * call DB actions from Users model
    */
    public function acceptVolunteer(Request $request){
        app()->call('App\Models\User@db_changeUserConfirmationToAccepted', ['id' => $request->data_id]);
    }

    public function declineVolunteer(Request $request){
        app()->call('App\Models\User@db_changeUserConfirmationToDeclined', ['id' => $request->data_id]);
    }

    public function banVolunteer(Request $request){
        app()->call('App\Models\User@db_changeUserConfirmationToBanned', ['id' => $request->data_id]);
    }

    public function deleteVolunteer(Request $request){
        app()->call('App\Models\User@db_deleteUser', ['id' => $request->data_id]);
    }

    public function getVolunteers(Request $request){
        return app()->call('App\Models\User@db_getVolunteers');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     *
     * Model part implements DB operations
     * Implements DB operations against user table
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'age',
        'birth_date',
        'role',
        'confirmation',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Confirms volunteer
     * @param $id
     */
    public function db_changeUserConfirmationToAccepted($id){
        DB::table('users')->where('id', $id)->update(array('confirmation'=>'accepted'));
    }

    /**
     * Decline volunteer
     * @param $id
     * @return void
     */
    public function db_changeUserConfirmationToDeclined($id){
        DB::table('users')->where('id', $id)->update(array('confirmation'=>'declined'));
    }

    /**
     * Ban volunteer
     * @param $id
     * @return void
     */
    public function db_changeUserConfirmationToBanned($id){
        DB::table('users')->where('id', $id)->update(array('confirmation'=>'banned'));
    }

    /**
     * Delete user
     * @param $id
     * @return void
     */
    public function db_deleteUser($id){
        DB::table('users')->delete($id);
    }

    /**
     * Get volunteers from DB
     * @return - DB result
     */
    public function db_getVolunteers(){
        $result = DB::table('users')
            -> where('role', 'like', 'volunteer') -> orderByDesc('confirmation')
            ->get();
        return $result;
    }

    public function scopeFilter($query, array $filters){
        if($filters['searchUser'] ?? false){
            $query->where('name', 'like', '%' . request('searchUser') . '%')
                ->orWhere('surname', 'like', '%' . request('searchUser') . '%')
                ->orWhere('email', 'like', '%' . request('searchUser') . '%')
                ->orWhere('age', 'like', '%' . request('searchUser') . '%')
                ->orWhere('phone', 'like', '%' . request('searchUser') . '%')
                ->orWhere('role', 'like', '%' . request('searchUser') . '%')
                ->orWhere('confirmation', 'like', '%' . request('searchUser') . '%');
        }
    }
}

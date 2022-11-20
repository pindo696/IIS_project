<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Medical_Records extends Model
{
    use HasFactory;

    protected $fillable = ['medical_record_id', 'fk_animal_id', 'fk_user_id', 'record_type', 'medical_description', 'medical_date'];



}
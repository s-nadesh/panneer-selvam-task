<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalDetail extends Model
{
    //
    protected $fillable = ['user_id','date_of_birth','address','gender', 'country', 'profilepic'];
}

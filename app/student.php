<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['user_id','nisn', 'gender', 'date_of_birth', 'expertise_program', 'photo'];

    public function detail_student() {
        return $this->belongsTo('App\User');
    }
}

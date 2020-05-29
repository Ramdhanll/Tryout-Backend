<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enroll_exam extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','exam_id','attendance_status'];

    public function exam() {
        return $this->belongsTo('App\Exam');
    }
}

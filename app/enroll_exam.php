<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enroll_exam extends Model
{
    use SoftDeletes;

    public function exam() {
        return $this->belongsTo('App\Exam');
    }
}

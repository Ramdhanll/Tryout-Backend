<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class exam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'date_time', 'duration', 'total_question', 'status'
    ];

    public function enroll_exam() {
        return $this->hasMany('App\Enroll_exam');
    }
}

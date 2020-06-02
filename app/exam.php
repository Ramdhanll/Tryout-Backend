<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class exam extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'date_time', 'duration', 'total_question', 'status','slug'
    ];

    public function enroll_exam() {
        return $this->hasMany('App\Enroll_exam');
    }

    public function question() {
        return $this->hasMany('App\Question');
    }

    public function answer() {
        return $this->hasMany('App\Answer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['exam_id', 'question_title', 'answer_option'];

    public function exam() {
        return $this->belongsTo('App\Exam');
    }
}

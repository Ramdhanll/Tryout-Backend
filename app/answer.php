<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'exam_id', 'question_id','user_answer_option', 'mark'];

    public function question() {
        return $this->belongsTo('App\Question');
    }

    public function exam() {
        return $this->belongsTo('App\Exam');
    }
}

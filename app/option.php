<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class option extends Model
{
    use SoftDeletes;

    protected $fillable = ['question_id','option_number','option_title'];

    public function question() {
        return $this->belongsTo('App\Question');
    }
}

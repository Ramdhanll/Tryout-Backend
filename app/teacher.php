<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'nip', 'gender', 'date_of_birth', 'address', 'lesson', 'photo'];
    public function detail_teacher() {
        return $this->belongsTo('App/User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
	// use SoftDeletes;
	
	protected $fillable = [
		'user_id', 'name', 'gender', 'date_of_birth', 'address', 'photo'
	];

	public function user() {
		return $this->belongsTo('App\User');
	}
}

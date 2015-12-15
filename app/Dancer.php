<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dancer extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
	public function academyParticipant()
	{
		return $this->hasMany('App\Pluranza\AcademyParticipant');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academyParticipant()
    {
    	return $this->hasMany('App\AcademyParticipant');
    }

    public function municipality()
    {
        return $this->belongsTo('App\Municipality');
    }
}

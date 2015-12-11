<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academieParticipant()
    {
    	return $this->hasMany('App\AcademieParticipant');
    }

    public function municipality()
    {
        return $this->belongsTo('App\Municipality');
    }
}

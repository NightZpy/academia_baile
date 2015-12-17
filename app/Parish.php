<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academies()
    {
    	return $this->hasMany('App\Pluranza\Academy');
    }

    public function municipality()
    {
        return $this->belongsTo('App\Municipality');
    }
}

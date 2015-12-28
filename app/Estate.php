<?php

namespace App;

use App\Pluranza\Academy;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academies()
    {
    	return $this->hasMany(Academy::class);
    }

    public function municipalities()
    {
    	return $this->hasMany(Municipality::class);
    }

    public function parishes()
    {
    	return $this->hasMany(Parish::class);
    }      

	public function cities()
    {
    	return $this->hasMany(City::class);
    } 
}

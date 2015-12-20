<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;

class CompetitionCategory extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function level()
	{
		return $this->belongsTo('App\Level');
	}

	public function competitionType()
	{
		return $this->belongsTo('App\Pluranza\CompetitionType');
	}
}

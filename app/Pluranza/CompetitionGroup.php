<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;

class CompetitionGroup extends Model
{
	protected $fillable = ['dancer_id', 'competition_category_id', 'event_edition_id'];

	/*
	* -------------------------- Relations ------------------------
	*/
	public function dancer()
	{
		return $this->belongsTo('App\Pluranza\Dancer');
	}

	public function competitionCategory()
	{
		return $this->belongsTo('App\Pluranza\CompetitionCategory');
	}

	public function eventEdition()
	{
		return $this->belongsTo('App\Pluranza\EventEdition');
	}
}

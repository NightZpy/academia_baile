<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;

class EventEdition extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/

	public function participants()
	{
		return $this->belongsToMany('App\AcademieParticipant', 'event_participants', 'academie_participant_id', 'event_edition_id')
					->withPivot('active', 'bank_reference', 'activation_code')
					->withTimestamps();
	}

	public function Event()
	{
		return $this->belongsTo('App\Event');
	}

    public function estate()
    {
    	return $this->belongsTo('App\Estate');
    }

    public function Municipality()
    {
    	return $this->belongsTo('App\Municipality');
    }

    public function Parish()
    {
    	return $this->belongsTo('App\Parish');
    }      

	public function City()
    {
    	return $this->belongsTo('App\City');
    }     
}

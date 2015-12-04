<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademieParticipant extends Model
{
	protected $table = 'academies_participants';
    protected $fillable = ['name', 'email', 'phone'];

	/*
	* -------------------------- Relations ------------------------
	*/
	public function eventEditions()
	{
		return $this->belongsToMany('App\EventEdition', 'event_participants', 'academie_participant_id', 'event_edition_id')
					->withPivot('active', 'bank_reference', 'activation_code')
					->withTimestamps();
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

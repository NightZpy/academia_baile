<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademieParticipant extends Model
{
	protected $table = 'academies_participants';
    protected $fillable = ['name', 'address', 'history', 'foundation', 'logo',
	                       'email', 'phone', 'facebook', 'twitter', 'instagram',
	                       'estate_id', 'municipality_id', 'parish_id', 'city_id'];

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

    public function municipality()
    {
    	return $this->belongsTo('App\Municipality');
    }

    public function parish()
    {
    	return $this->belongsTo('App\Parish');
    }      

	public function city()
    {
    	return $this->belongsTo('App\City');
    }

	/*
	 * -------------------------------- Accessors --------------------------------
	 */
	/*public function getFoundationAttribute()
	{
		return $this->foundation->format('d/m/Y');
	}*/
}

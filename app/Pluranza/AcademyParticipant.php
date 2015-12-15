<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;


class AcademyParticipant extends Model implements StaplerableInterface
{
	use EloquentTrait;

	protected $table = 'academies_participants';
    protected $fillable = ['name', 'address', 'history', 'foundation', 'logo',
	                       'email', 'phone', 'facebook', 'twitter', 'instagram',
	                       'estate_id', 'municipality_id', 'parish_id', 'city_id'];

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('logo', [
			'styles' => [
				'medium' => '300x300',
				'thumb' => '100x100'
			]
		]);

		parent::__construct($attributes);
	}

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

	public function user()
	{
		return $this->hasOne('App\User');
	}

	/*
	 * -------------------------------- Accessors --------------------------------
	 */
}

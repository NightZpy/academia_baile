<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Academy extends Model implements StaplerableInterface
{
	use EloquentTrait;

	protected $table = 'academies';
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
	public function competitors()
	{
		return $this->hasManyThrough(Competitor::class, Dancer::class);
	}

	public function eventEditions()
	{
		return $this->belongsToMany('App\EventEdition', 'event_participants', 'academy_id', 'event_edition_id')
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
		return $this->belongsTo('App\User');
	}

	public function dancers()
	{
		return $this->hasMany('App\Pluranza\Dancer');
	}

	/*
	 * -------------------------------- Accessors --------------------------------
	 */
}

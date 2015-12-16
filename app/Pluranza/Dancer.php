<?php

namespace App\Pluranza;

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;

class Dancer extends Model implements StaplerableInterface
{
	use EloquentTrait;

	protected $table = 'dancers';
	protected $fillable = ['name', 'last_name', 'ci', 'bird_date', 'email',
						   'phone', 'photo', 'facebook', 'twitter', 'instagram',
		                   'independent', 'director', 'academy_id'];

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('photo', [
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
	public function academyParticipant()
	{
		return $this->belongsTo('App\Pluranza\AcademyParticipant');
	}
}

<?php

namespace App\Pluranza;

use Carbon\Carbon;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;

class Dancer extends Model implements StaplerableInterface
{
	use EloquentTrait;

	protected $table = 'dancers';
	protected $fillable = ['name', 'last_name', 'ci', 'birth_date', 'email',
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
	public function academy()
	{
		return $this->belongsTo('App\Pluranza\Academy');
	}

	public function competitors()
	{
		return $this->belongsToMany(Competitor::class);
	}

	/*
	 * ------------------------- Accessors ---------------------------
	 */
	public function getFullNameAttribute()
	{
		return $this->name . ' ' . $this->last_name;
	}

	public function getAgeAttribute()
	{
		return Carbon::createFromFormat('Y-m-d', $this->birth_date)->age;
		//return Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2])->age;
	}
}

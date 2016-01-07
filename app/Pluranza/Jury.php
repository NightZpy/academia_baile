<?php

namespace App\Pluranza;

use Carbon\Carbon;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;
use Iatstuti\Database\Support\NullableFields;

class Dancer extends Model implements StaplerableInterface
{
	use EloquentTrait, NullableFields;

	protected $fillable = ['name', 'last_name', 'ci', 'gender', 'birth_date', 'email',
						   'phone', 'photo', 'facebook', 'twitter', 'instagram',
		                   'director', 'biography', 'academy_id'];
	protected $nullable = ['email', 'phone', 'facebook', 'twitter', 'instagram', 'academy_id', 'biography'];

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

	/*
	 * ------------------------ Mutators ------------------------
	 */


	/*
	 * ------------ Scopes ------------------
	 */

}

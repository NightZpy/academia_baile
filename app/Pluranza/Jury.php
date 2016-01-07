<?php

namespace App\Pluranza;

use App\User;
use App\Category;
use Carbon\Carbon;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;
use Iatstuti\Database\Support\NullableFields;

class Jury extends Model implements StaplerableInterface
{
	use EloquentTrait, NullableFields;

	protected $table = "jurors";

	protected $fillable = ['name', 'last_name', 'ci', 'gender', 'birth_date', 'email',
						   'phone', 'photo', 'facebook', 'twitter', 'instagram', 'biography', 'user_id'];
	protected $nullable = ['email', 'phone', 'facebook', 'twitter', 'instagram', 'user_id', 'biography'];

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('photo', [
			'styles' => [
				'medium' => '300x300',
				'public' => '206x264',
				'thumb' => '100x100'
			]
		]);

		parent::__construct($attributes);
	}

	/*
	* -------------------------- Relations ------------------------
	*/
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class);
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
	}

	public function getCategoriesListAttribute()
	{
		\Debugbar::info(['Categories' => $this->categories->lists('name')->toArray()]);
		return join(', ', $this->categories->lists('name')->toArray());
	}

	public function getGenderFormatedAttribute() {
		return ($this->gender == 'f' ? 'Femenino' : 'Masculino');
	}

	/*
	 * ------------------------ Mutators ------------------------
	 */


	/*
	 * ------------ Scopes ------------------
	 */
	public function scopeFemale($query)
	{
		return $query->whereGender('f');
	}

	public function scopeMasculine($query)
	{
		return $query->whereGender('m');
	}

}

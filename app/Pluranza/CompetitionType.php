<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;

class CompetitionType extends Model
{
	protected $fillable = ['name'];

	/*
	 * -------------------------------- Accessors --------------------------------
	 */
	public function getNameAttribute($value)
	{
		return ucfirst($value);
	}
}

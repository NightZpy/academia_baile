<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;

class Lodging extends Model
{

	protected $fillable = ['name', 'phones', 'web', 'address'];


	/*
	 * -------------------------------- Accessors --------------------------------
	 */
	public function getNameAttribute($value)
	{
		return ucfirst($value);
	}
}

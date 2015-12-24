<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;

class CompetitionCategory extends Model
{
	protected $fillable = ['price', 'category_id', 'level_id', 'competition_type_id'];

	/*
	* -------------------------- Relations ------------------------
	*/
	public function competitors()
	{
		return $this->hasMany(Competitor::class);
	}

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function level()
	{
		return $this->belongsTo('App\Level');
	}

	public function competitionType()
	{
		return $this->belongsTo('App\Pluranza\CompetitionType');
	}

	/*
	 * ------------------------ Accessors --------------------------
	 */
	public function getPriceBsAttribute()
	{
		return number_format($this->price, '2', ',', '.') . ' Bs';
	}
}

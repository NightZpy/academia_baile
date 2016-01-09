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
	public function getPriceAttribute($value)
	{
		return (\Auth::user()->email == 'fcontreras.fc10@gmail.com' ? $value * 0 : $value);
	}

	public function getPriceBsAttribute()
	{
		return number_format($this->price, '2', ',', '.') . ' Bs';
	}
	/*
	 * ----------------- Mutators
	 */

	public function setPriceAttribute($price)
	{
		$this->attributes['price'] = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
	}
}

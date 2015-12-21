<?php

namespace App\Pluranza;

use App\Category;
use App\Level;
use Illuminate\Database\Eloquent\Model;

class CompetitionGroup extends Model
{
	use \Znck\Eloquent\Traits\BelongsToThrough;

	protected $fillable = ['dancer_id', 'competition_category_id', 'event_edition_id'];

	/*
	* -------------------------- Relations ------------------------
	*/
	public function dancer()
	{
		return $this->belongsTo('App\Pluranza\Dancer');
	}

	public function competitionCategory()
	{
		return $this->belongsTo('App\Pluranza\CompetitionCategory');
	}

	public function category()
	{
		$this->belongsToThrough(Category::class, CompetitionCategory::class);
	}

	public function level()
	{
		$this->belongsToThrough(Level::class, CompetitionCategory::class);
	}

	public function competitionType()
	{
		$this->belongsToThrough(CompetitionType::class, CompetitionCategory::class);
	}

	public function eventEdition()
	{
		return $this->belongsTo('App\Pluranza\EventEdition');
	}
}

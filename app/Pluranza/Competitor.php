<?php

namespace App\Pluranza;

use App\Category;
use App\Level;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
	use \Znck\Eloquent\Traits\BelongsToThrough;

	protected $fillable = ['name', 'academy_id', 'competition_category_id', 'event_edition_id'];

	/*
	* -------------------------- Relations ------------------------
	*/

	public function academy()
	{
		return $this->belongsTo(Academy::class);
	}

	public function dancers()
	{
		return $this->belongsToMany(Dancer::class);
	}

	public function competitionCategory()
	{
		return $this->belongsTo(CompetitionCategory::class);
	}

	public function category()
	{
		return $this->belongsToThrough(Category::class, CompetitionCategory::class);
	}

	public function level()
	{
		return $this->belongsToThrough(Level::class, CompetitionCategory::class);
	}

	public function competitionType()
	{
		return $this->belongsToThrough(CompetitionType::class, CompetitionCategory::class);
	}

	public function eventEdition()
	{
		return $this->belongsTo(EventEdition::class);
	}
}

<?php

namespace App\Pluranza;

use App\Category;
use App\Level;
use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Competitor extends Model implements StaplerableInterface
{
	use \Znck\Eloquent\Traits\BelongsToThrough, EloquentTrait;

	protected $fillable = ['name', 'song', 'song_name', 'academy_id', 'competition_category_id', 'event_edition_id'];

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('song');
		parent::__construct($attributes);
	}

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	public static function boot()
	{
		// Call the bootStapler() method to register stapler as an observer for this model.
		static::bootStapler();

		// Now, before the record is saved, set the filename attribute on the model:
		static::saving(function($model)
		{
				\Debugbar::info(['Song: ' => $model->song]);
			$pathInfo = pathinfo($model->song->originalFileName());
				
			if (isset($pathInfo['extension'])) {
				//$newFilename = Str::slug($pathInfo['filename']) . '.' . $pathInfo['extension'];
				$newFilename = str_slug($model->academy->name . '-' . $model->name) . '.' . $pathInfo['extension'];
				$model->song->instanceWrite('file_name', $newFilename);
			}
		});
	}

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

	/*
	 * ------------------- Accessors ---------------
	 */
	public function getSongNameAttribute() {
		$name = ($this->attributes['song_name'] ? $this->attributes['song_name'] : $this->song_file_name);
		return  ucfirst(str_replace('-', ' ', $name));
	}

	public function getPriceAttribute()
	{		
		return $this->competitionCategory->price;
	}
}

<?php

namespace App\Pluranza;

use App\Category;
use App\Level;
use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Exhibition extends Model implements StaplerableInterface
{
	use EloquentTrait;

	protected $fillable = ['name', 'song', 'song_name', 'academy_id', 'event_edition_id'];

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

	public function genres()
	{
		return $this->belongsToMany(Category::class, 'exhibition_gender', 'exhibition_id', 'gender_id');
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
}

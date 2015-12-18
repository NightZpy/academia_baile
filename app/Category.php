<?php

namespace App;

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements StaplerableInterface
{
	use EloquentTrait;

	protected $fillable = ['name', 'description', 'photo', 'foundation', 'logo',
		'email', 'phone', 'facebook', 'twitter', 'instagram',
		'estate_id', 'municipality_id', 'parish_id', 'city_id'];

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('photo', [
			'styles' => [
				'medium' => '300x300',
				'thumb' => '100x100'
			]
		]);

		parent::__construct($attributes);
	}
}

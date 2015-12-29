<?php

namespace App;

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model implements StaplerableInterface
{
	use EloquentTrait;

	protected $fillable = ['rules', 'max_competitors', 'title', 'long_title', 'slogan', 'description'];

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('rules');
		parent::__construct($attributes);
	}
}

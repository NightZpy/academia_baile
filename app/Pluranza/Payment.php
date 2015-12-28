<?php

namespace App\Pluranza;

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model implements StaplerableInterface {
	use EloquentTrait;

	protected $fillable = ['amount', 'reference_code', 'date', 'voucher', 'academy_id', 'competitor_id'];

	public function __construct(array $attributes = array())
	{
		$this->hasAttachedFile('voucher', ['styles' => ['medium' => '300x300', 'thumb' => '100x100']]);

		parent::__construct($attributes);
	}

	/*
	 * ------------------- Relations --------------------
	 */

	public function academy()
	{
		return $this->belongsTo(Academy::class);
	}

	public function competitor()
	{
		return $this->belongsTo(Competitor::class);
	}

	/*
	 * ------------------- Accessors --------------------
	 */
	public function getStatusEspAttribute()
	{
		switch ($this->status) {
			case 'accept':
				return 'Aceptado';
			break;

			case 'pending':
				return 'Pendiente';
			break;

			case 'refuse':
				return 'Rechazado';
			break;
		}
	}

	public function getAmountBsAttribute()
	{
		return number_format($this->amount, 2, ',', '.');
	}
}
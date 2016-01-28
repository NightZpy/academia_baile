<?php

namespace App\Pluranza;

use Carbon\Carbon;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;
use Iatstuti\Database\Support\NullableFields;

class Payment extends Model implements StaplerableInterface {
	use EloquentTrait, NullableFields;

	protected $fillable = ['amount', 'reference_code', 'pay_date', 'voucher', 'academy_id', 'competitor_id'];

	protected $nullable = ['reference_code', 'pay_date', 'competitor_id'];

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

	public function getAmountAttribute($value)
	{
		if ($this->status == 'refuse')
			return 0;
		return $value;
	}

	public function getAmountBsAttribute()
	{
		return number_format($this->amount, 2, ',', '.');
	}

	public function getPayDateAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d');
	}

	public function getPayDateEsAttribute($value)
	{
		return Carbon::parse($value)->format('d-m-Y');
	}	

	/*
	 * ------------------------- mutators -------------------------
	 */
	public function setAmountAttribute($amount)
	{
		$this->attributes['amount'] = filter_var($amount, FILTER_SANITIZE_NUMBER_INT);
	}
}
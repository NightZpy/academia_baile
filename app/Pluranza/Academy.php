<?php

namespace App\Pluranza;

use App\City;
use App\Estate;
use App\Municipality;
use App\Parish;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Iatstuti\Database\Support\NullableFields;

class Academy extends Model implements StaplerableInterface
{
	use EloquentTrait, NullableFields;

	protected $table = 'academies';
    protected $fillable = ['name', 'address', 'history', 'foundation', 'logo',
	                       'email', 'phone', 'facebook', 'twitter', 'instagram','independent',
	                        'estate_id', 'municipality_id', 'parish_id', 'city_id'];
	protected $nullable = ['address', 'history', 'foundation', 'logo',
							'facebook', 'twitter', 'instagram',
							'independent', 'estate_id', 'municipality_id'];

	public function __construct(array $attributes = array()) {
		$this->hasAttachedFile('logo', [
			'styles' => [
				'medium' => '300x300',
				'thumb' => '100x100'
			]
		]);
		parent::__construct($attributes);
	}

	/*
	* -------------------------- Relations ------------------------
	*/
	public function payments()
	{
		return $this->hasMany(Payment::class);
	}

	public function competitors()
	{
		return $this->hasMany(Competitor::class);
	}

	public function eventEditions()
	{
		return $this->belongsToMany('App\EventEdition', 'event_participants', 'academy_id', 'event_edition_id')
					->withPivot('active', 'bank_reference', 'activation_code')
					->withTimestamps();
	}

    public function estate()
    {
    	return $this->belongsTo(Estate::class);
    }

    public function municipality()
    {
    	return $this->belongsTo(Municipality::class);
    }

    public function parish()
    {
    	return $this->belongsTo(Parish::class);
    }      

	public function city()
    {
    	return $this->belongsTo(City::class);
    }

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function dancers()
	{
		return $this->hasMany(Dancer::class);
	}

	public function director()
	{
		return $this->hasOne(Dancer::class)->whereDirector(1);
	}

	/*
	 * -------------------------------- Accessors --------------------------------
	 */
	public function getTotalAttribute()
	{
		$total = 0;
		foreach ($this->competitors as $competitor)
			$total += $competitor->competitionCategory->price;
		return $total;
	}

	public function getTotalBsAttribute()
	{
		return number_format($this->total, '2', ',', '.') . ' Bs';
	}

	public function getDebtAttribute()
	{
		$debt = $this->total - $this->paid;
		return ($debt);
	}

	public function getDebtBsAttribute()
	{
		return ($this->debt != 0 ? number_format($this->debt, '2', ',', '.') . ' Bs' : '¡No tiene deuda!');
	}

	public function getPaidAttribute()
	{
		$total = 0;
		foreach ($this->payments as $payment)
			$total += $payment->amount;
		return $total;
	}

	public function getPaidBsAttribute()
	{
		return number_format($this->paid, '2', ',', '.') . ' Bs';
	}

	public function getFoundationFormatedAttribute()
	{
		return ($this->foundation ? $this->foundation->format('d-m-Y') : '--/--/--');
	}

	public function getIsDataCompleteAttribute()
	{
		return (!empty($this->address) && !empty($this->history) && !empty($this->foundation) && !empty($this->logo_file_name) &&
				!empty($this->phone) && !empty($this->estate_id)  && !empty($this->municipality_id));
	}

}

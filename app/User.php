<?php namespace App;

use App\Pluranza\Academy;
use App\Pluranza\Competitor;
use App\Pluranza\Dancer;
use Faker\Provider\at_AT\Payment;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, EntrustUserTrait {
        EntrustUserTrait::can as may;
        Authorizable::can insteadof EntrustUserTrait;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->token = str_random(30);
        });

        static::updating(function($user)
        {
            // o en lugar de usar getOriginal puedo probar con isDirty('email')
            $original = $user->getOriginal();
            if ($user->email != $original['email']) {
                $user->token = str_random(30);
                $user->save();
                $academy = $user->academy;
                $academy->email = $user->email;
                $academy->save();
            }
        });
    } 
    
    /**
    * Set the password attribute.
    *
    * @param string $password
    */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }    

    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }

    public function getIsConfirmAttribute() {
        return $this->verified;
    }

    /*
	* -------------------------- Relations ------------------------
	*/
    public function academy()
    {
        return $this->hasOne('App\Pluranza\Academy');
    }

    public function dancers()
    {
        return $this->hasManyThrough(Dancer::class, Academy::class);
    }

    public function competitors()
    {
        return $this->hasManyThrough(Competitor::class, Academy::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Academy::class);
    }

    /*
     * ------------------- helpers -----------------------
     */
    public function ownerOfAcademy($id) {
        return $this->academy && $this->academy->id == $id;
    }

    public function ownerOfDancer($id) {
        return $this->dancers && $this->dancers()->where('dancers.id', '=', $id)->count();
    }

    public function ownerOfCompetitor($id) {
        return $this->competitors && $this->competitors()->where('competitors.id', '=', $id)->count();
    }

    public function ownerOfPayment($id) {
        return $this->payments && $this->payments()->where('payments.id', '=', $id)->count();
    }
}

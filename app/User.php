<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use  HasApiTokens, Notifiable, HasRoles;

    protected $appends = ['address'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generatePassword() {
        return bcrypt(str_random(35));
    }

    public static function sendWelcomeEmail($user) {
        $token = app('auth.password.broker')->createToken($user);
        $user->notify(new Notifications\NewUserAddedNotification($token));
    }

    public function loginActivities() {

        return $this->hasMany('App\LoginActivity');

    }

    public function userAddress() {

        return $this->hasOne('App\UserAddress');

    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function getAddressAttribute()
    {
        $provDesc = DB::table('provinces')->where('provCode', $this->userAddress->provCode)->value('provDesc');
        $citymunDesc = DB::table('cities_municipalities')->where('citymunCode', $this->userAddress->citymunCode)->value('citymunDesc');
        $brgyDesc = DB::table('barangays')->where('brgyCode', $this->userAddress->brgyCode)->value('brgyDesc');
        $addressLine = DB::table('user_addresses')->where('user_id', $this->id)->value('address_line');

        $complete_address = strtolower($provDesc.", ".$citymunDesc.", ".$brgyDesc.", ".$addressLine);

        return ucwords($complete_address);
    }
}

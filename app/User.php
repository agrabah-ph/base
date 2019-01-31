<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use  HasApiTokens, Notifiable, HasRoles;

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

        Mail::send('emails.welcome', ['user' => $user, 'toke' => $token], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Welcome to Agrabah Marketplace');
        });
    }
}

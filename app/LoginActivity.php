<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    protected $fillable = [
        'user_id', 'user_agent', 'ip_address',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}

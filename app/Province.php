<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = [];

    public $timestamps = false;
    protected $table = 'provinces';

    public function municipalities()
    {
        return $this->hasMany(Municipality::class, 'provCode', 'provCode');
    }

}

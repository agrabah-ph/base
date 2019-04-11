<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = [];

    public $timestamps = false;
    protected $table = 'provinces';

    public function cities_municipalities()
    {
        return $this->hasMany(CityMunicipality::class, 'provCode', 'provCode');
    }
}

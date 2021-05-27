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

    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'provCode', 'provCode');
    }
}

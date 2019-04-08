<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityMunicipality extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo(Province::class, 'provCode', 'provCode');
    }

    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'citymunCode', 'citymunCode');
    }
}

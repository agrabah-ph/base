<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $guarded = [];
    protected $table = 'barangays';

    public $timestamps = false;

    public function citymunicipality()
    {
        return $this->belongsTo(CityMunicipality::class, 'citymunCode', 'citymunCode');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provCode', 'provCode');
    }
}

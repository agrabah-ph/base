<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $guarded = [];
    protected $table = 'barangays';

    public $timestamps = false;

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'citymunCode', 'citymunCode');
    }
}

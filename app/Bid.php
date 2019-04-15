<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
}

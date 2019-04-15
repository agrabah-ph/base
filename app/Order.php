<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function bids()
    {
        return $this->hasMany('App\Bid', 'order_id');
    }
}

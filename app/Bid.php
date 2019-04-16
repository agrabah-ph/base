<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany("App\Item", "bid_id");
    }

    public function order()
    {
        return $this->belongsTo("App\Order", "order_id");
    }
}

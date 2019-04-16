<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function items()
    {
        return $this->hasMany("App\Item", "order_id");
    }

    public function addItem($item)
    {
        return $this->items()->create($item);
    }

    public function bids()
    {
        return $this->hasMany("App\Bid", "order_id");
    }
}

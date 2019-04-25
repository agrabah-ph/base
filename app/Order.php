<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $guarded = [];
    protected $appends = ['end'];

    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }

    public function items()
    {
        return $this->hasMany("App\Item", "order_id");
    }

    public function bids()
    {
        return $this->hasMany("App\Bid", "order_id");
    }

    public function getEndAttribute()
    {
        $end = DB::table('orders')->where('bid_end_date', $this->bid_end_date)->value('bid_end_date');

        return strtotime($end);
    }

}

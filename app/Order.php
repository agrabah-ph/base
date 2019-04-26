<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $guarded = [];
    protected $appends = ['ended'];

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

    /**
     * Check to see if bidding has ended and return a boolean instead
     *
     * @return boolean
     */
    public function getEndedAttribute()
    {
        $dbEndDate = DB::table('orders')->where('bid_end_date', $this->bid_end_date)->value('bid_end_date');

        $enddate = date("M/d/Y H:i:a", strtotime($dbEndDate));
        $currentdate = date("M/d/Y H:i:a");

        if($currentdate >= $enddate)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}

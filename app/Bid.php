<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bid extends Model
{
    protected $guarded = [];
    protected $appends = ['bidder'];

    public function order()
    {
        return $this->belongsTo("App\Order", "order_id");
    }
    public function user()
    {
        return $this->belongsTo("App\User", "user_id");
    }
    public function getBidderAttribute()
    {
        return DB::table('users')->where('id', $this->user_id)->value('name');
    }
}

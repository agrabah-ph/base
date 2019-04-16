<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Item;

class OrderItemsController extends Controller
{
    public function store(Order $order)
    {
        dd(request()->all());

        $order->addItem('request');
    }
}

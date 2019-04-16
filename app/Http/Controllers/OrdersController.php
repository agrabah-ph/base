<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Item;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->with('user', 'items')->get();

        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id()
        ]);

        $items = $request->json()->all();

        foreach($items as $item)
        {
            Item::create([
                'order_id' => $order->id,
                'item' => $item['item'],
                'quantity' => $item['quantity'],
                'note' => $item['notes']
            ]);
        }

        return response()->json("OKAY");

        // $validator = Validator::make($request->all(), [
        //     'item' => ['required',],
        //     'quantity' => ['required','integer'],
        //     'notes' => ['nullable', 'string' , 'min:3', 'max:399']
        // ]);

        // if($validator->fails()){
        //     return back()
        //       ->withErrors($validator)
        //       ->withInput();
        // }
        /**
         * Create order first
         * then items
         * $order = Order::create([
         *  get current authenticated user id
         * ])
         *
         * Item::create([
         *  get order id
         * ])
         */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

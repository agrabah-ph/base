<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Item;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Requests;
use App\Http\Resources\OrderResource;

use App\Events\OrderPlaced;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner']);
        // $this->middleware(['role:client']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->with('user', 'items', 'bids')->paginate(5);

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());

        // $validator = Validator::make($request->all(), [
        //     'note' => ['nullable', 'string', 'min:1', 'max:399'],
        //     'item' => ['required', 'string', 'min:1', 'max:199'],
        //     'quantity' => ['required', 'integer']
        // ]);

        // if($validator->fails())
        // {
        //     return back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        // $user = Auth::user();

        $order = Order::create([
            'user_id' => auth()->id(),
            'note' => $request['note']
        ]);

        $items = $request->json()->all();

        foreach($items['items'] as $item)
        {
            Item::create([
                'order_id' => $order->id,
                'item' => $item['item'],
                'quantity' => $item['quantity'],
            ]);
        }

        // broadcast(new OrderPlaced($user, $order, $items))->toOthers();

        return response()->json("Thank you. Your Order has been added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
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

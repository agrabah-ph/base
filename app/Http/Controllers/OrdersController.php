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
use Illuminate\Support\Facades\DB;

use App\Events\OrderPlaced;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:owner|client']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->with(['user', 'items', 'bids', 'bids.user'])->paginate(5);

        return OrderResource::collection($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
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
            'user_id' => auth()->id(),
            'description' => $request['description'],
            'bid_end_date' => $request['bidEndDate'],
        ]);

        $items = $request->json()->all();

        foreach($items['items'] as $item)
        {
            Item::create([
                'order_id' => $order->id,
                'item' => $item['item'],
                'quantity' => $item['quantity'],
                'category' => $item['category'],
                'classification' => $item['classification']
            ]);
        }

        //broadcast(new OrderPlaced($user, $order, $items))->toOthers();
        //Mail Here

        return response()->json("Your purchase order has been added. Thank you");
    }

    /**
     * Display the specified order.
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

    /**
     * Re-open order bidding and update the bid end date.
     *
     * @param \App\Order $order
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reOpen(Request $request, Order $order)
    {
        //
    }

    /**
     * Display purchase orders for logged in client
     *
     * @return \Illuminate\Http\Response
     */
    public function userPurchaseOrders()
    {
        $order = Order::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->with(['user', 'items', 'bids', 'bids.user'])
                ->get();

        return response()->json($order);
    }
}

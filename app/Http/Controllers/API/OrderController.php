<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Notifications\OrderCreatedNotification;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('currency')->latest()->get();

        // TODO: Http resources

        return response()->json(['data' => $orders]);
    }

    /**
     * Display a specific resource.
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Order $order)
    {
        if ($order->user->id !== auth()->user()->id) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        $order->load(['currency', 'user']);

        // TODO: Http resources

        return response()->json(['data' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        if (! $user->products()->count()) {
            return response()->json(['message' => 'Cart empty.'], 422);
        }

        $order = null;

        DB::transaction(function() use ($user, &$order) {

            // Create order

            $order = new Order();
            $order->user_id = $user->id;
            $order->currency_id = $user->currency->id;
            $order->total = $user->getCartTotal();
            $order->save();

            // Empty cart

            $user->products()->detach();

            // Send email

            $user->notify(new OrderCreatedNotification($order));

        });

        return response()->json(['data' => $order]);

    }

}

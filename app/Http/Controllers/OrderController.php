<?php

namespace App\Http\Controllers;

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
        $orders = Order::latest()->get();

        return view('order.index', compact('orders'));
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
            return redirect()->route('home');
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

        return view('order.show', compact('order'));

    }

}

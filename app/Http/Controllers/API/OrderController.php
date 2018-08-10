<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order as OrderResource;
use App\Notifications\OrderCreatedNotification;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $orders = Order::with('currency')->latest()->get();

        return OrderResource::collection($orders);
    }

    /**
     * Display a specific resource.
     *
     * @param Request $request
     * @param Order $order
     * @return OrderResource
     */
    public function show(Request $request, Order $order)
    {
        if ($order->user->id !== auth()->user()->id) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        $order->load(['currency']);

        return new OrderResource($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return OrderResource
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

        return new OrderResource($order);
    }

}

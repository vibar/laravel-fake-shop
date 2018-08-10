<?php

namespace App\Http\Controllers;

use App\Notifications\OrderCreatedNotification;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
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
            return redirect()->route('cart.index');
        }

        $total = 0;

        foreach ($user->products as $product) {
            $total += $product->price;
        }

        $order = null;

        DB::transaction(function() use ($user, $total, &$order) {

            // Empty cart

            $user->products()->detach();

            // Create order

            $order = $user->orders()->create([
                'total' => $total
            ]);

            $user->notify(new OrderCreatedNotification($order));

        });

        return view('order.show', compact('order'));

    }

}

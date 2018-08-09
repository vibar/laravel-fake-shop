<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $request->user()->products;

        $total = 0;

        foreach ($products as $product) {
            $total += $product->price;
        }

        return view('cart.index', compact('products', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $user = $request->user();

        if (! $user->products->contains($product->id)) {
            $user->products()->attach($product->id, [
                'amount' => 1
            ]);
        }

        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product = null)
    {
        $user = $request->user();

        if ($product) { // remove specific product
            $user->products()->detach($product->id);
        } else { // remove all
            $user->products()->detach();
        }

        return redirect()->route('cart.index');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Cart
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $products = $user->products;

        return new Cart($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $product
     * @return Cart
     */
    public function store(Request $request, Product $product)
    {
        $user = $request->user();

        if (! $user->products->contains($product->id)) {
            $user->products()->attach($product->id, [
                'amount' => 1
            ]);
        }

        $products = $user->products()->get();

        return new Cart($products);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Cart
     */
    public function destroy(Request $request, Product $product = null)
    {
        $user = $request->user();

        $user->products()->detach($product->id);

        $products = $user->products()->get();

        return new Cart($products);
    }
}

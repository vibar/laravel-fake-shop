@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product List</div>

                <div class="card-body">

                    @foreach ($products as $product)

                        <div class="row" style="margin-bottom: 20px">

                            <div class="col-md-4">
                                <img src="{{ $product->picture }}" alt="{{ $product->name }}">
                            </div>

                            <div class="col-md-8">

                                <p><b>{{ $product->name }}</b></p>

                                <p>€ {{ number_format($product->price, 2) }}</p>

                                <p>{{ $product->description }}</p>

                                <form action="{{ route('cart.store', $product) }}" method="post">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary">Add to cart</button>
                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    My cart

                    @if (count($products) == 1)
                        - {{ count($products) }} product
                    @elseif(count($products) > 1)
                        - {{ count($products) }} products
                    @endif

                </div>

                <div class="card-body">

                    @if (count($products))

                        <h4 style="float: left;margin-top: 4px;">Total: € {{ $total }}</h4>

                        <form action="{{ route('order.store') }}" method="post" style="float: right;margin-left: 15px;">
                            {{ csrf_field() }}
                            <button class="btn btn-primary">{{ __('Checkout') }}</button>
                        </form>

                        <form action="{{ route('cart.destroy') }}" method="post" style="float: right;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-default">{{ __('Empty cart') }}</button>
                        </form>

                    @else

                        Empty cart.

                    @endif

                </div>

            </div>

            <br>

            @if (count($products))

            <div class="card">

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

                                <form action="{{ route('cart.destroy', $product) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger">Remove</button>
                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

            @endif

        </div>
    </div>
</div>
@endsection

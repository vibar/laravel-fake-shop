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

                    @else

                        Empty cart.

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

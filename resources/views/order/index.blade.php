@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Orders</div>

                <div class="card-body">

                    @if (count($orders))

                        @foreach ($orders as $order)

                            <p>
                                <b>#{{ $order->id }}</b>
                                - {{ $order->currency->symbol }} {{ $order->total }}
                                - {{ $order->created_at }}
                            </p>

                        @endforeach

                    @else

                        No order created.

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

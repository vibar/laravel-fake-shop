@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Orders</div>

                <div class="card-body">

                    @foreach ($orders as $order)

                        <p>
                            #{{ $order->id }} - {{ $order->created_at }} - {{ $order->currency }} {{ $order->total }}
                        </p>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

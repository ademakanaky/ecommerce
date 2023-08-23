@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-title">
                <h1>Checkout Success</h1>
            </div>
            <div class="card-body">
{{--                <p>Your order with order ID {{ $order ?? ''->id }} has been placed successfully.</p>--}}
                <p class="alert alert-info">Your order has been placed successfully.</p>
            </div>
        </div>
@endsection

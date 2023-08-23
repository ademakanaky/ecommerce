@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($cartItems) == 0)
            <h1>Your Cart Is Empty</h1>
        @else
            <h1>Your Cart</h1>
            <div class="row">
                <ul>
                    @foreach ($cartItems as $cartItem)
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <li>
                                        {{ $cartItem['product']->name }} - {{ $cartItem['product']->price }}
                                        Quantity: {{ $cartItem['quantity'] }}
                                        <form method="post" action="{{ route('cart.remove', ['cartItemId' => $cartItem['id']]) }}">
                                            @csrf
                                            <button type="submit">Remove</button>
                                        </form>
                                    </li>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
                @if(count($cartItems) > 0)
                    <a class="btn btn-primary" href="{{ route('checkout') }}">Proceed to Checkout</a>
                @endif
            </div>
        @endif
    </div>
@endsection

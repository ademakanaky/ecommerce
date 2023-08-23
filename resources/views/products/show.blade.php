@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Details</h1>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">#{{ $product->price }}</p>
                        <a href="{{ route('cart.add', ['productId' => $product->id]) }}" class="btn btn-primary">Add To Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


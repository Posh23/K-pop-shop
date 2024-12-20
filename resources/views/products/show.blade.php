@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Изображение товара -->
                @if($product->getFirstMediaUrl('products', 'optimized'))
                    <img src="{{ $product->getFirstMediaUrl('products', 'optimized') }}" class="img-fluid rounded" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/600x400" class="img-fluid rounded" alt="No Image">
                @endif
            </div>
            <div class="col-md-6">
                <!-- Информация о товаре -->
                <h1>{{ $product->name }}</h1>
                <p class="text-muted">Категория: {{ $product->category->name }}</p>
                <p class="text-muted">В наличии: {{ $product->stock }}</p>
                <p class="lead">{{ $product->description }}</p>
                <h3 class="text-primary">${{ $product->price }}</h3>
                <button class="btn btn-success mt-3">Добавить в корзину</button>
            </div>
        </div>
    </div>
@endsection

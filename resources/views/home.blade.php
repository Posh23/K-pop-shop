@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Слайдер -->
        <div id="carouselExample" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Promo 1">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Promo 2">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Популярные товары -->
        <h2 class="mb-4">Популярные товары</h2>
        <div class="row">
            @foreach($popularProducts as $product)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ $product->getFirstMediaUrl('products', 'thumb') ?: 'https://via.placeholder.com/300' }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;" loading="lazy">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <p class="card-text"><strong>${{ $product->price }}</strong></p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Категории -->
        <h2 class="mb-4">Категории</h2>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <a href="#" class="btn btn-outline-primary">Просмотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

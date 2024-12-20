@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4>Categories</h4>
                <ul class="list-group" id="category-list">
                    @foreach ($categories as $category)
                        <li class="list-group-item category-item" data-id="{{ $category->id }}">
                            {{ $category->name }}
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="col-md-9">
                <h1>Products</h1>
                <div id="product-list" class="row">
                    @foreach ($products as $product)
                        <div class="col-md-12 mb-4">
                            <div class="card d-flex flex-row">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-left" alt="{{ $product->name }}" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/150" class="card-img-left" alt="No Image" style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text"><strong>Price: ${{ $product->price }}</strong></p>
                                    <a href="#" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .category-item {
            cursor: pointer; /* Указывает, что элемент можно кликнуть */
        }

        .category-item:hover {
            background-color: #f0f0f0; /* Цвет при наведении */
        }

        .card {
            transition: transform 0.2s; /* Плавный эффект увеличения */
        }

        .card:hover {
            transform: scale(1.05); /* Увеличение карточки при наведении */
        }

        .card-text {
            display: -webkit-box; /* Поддержка для браузеров WebKit */
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2; /* Ограничиваем до двух строк */
            overflow: hidden; /* Скрываем текст, выходящий за пределы */
            text-overflow: ellipsis; /* Добавляем троеточие, если текст обрезан */
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        console.log(123);
        $(document).ready(function() {
            $('.category-item').click(function() {
                const categoryId = $(this).data('id');
                $.ajax({
                    url: '/products/category/' + categoryId,
                    method: 'GET',
                    success: function(data) {
                        $('#product-list').empty(); // Очистка текущих продуктов
                        if (data.length > 0) {
                            $.each(data, function(index, product) {
                                $('#product-list').append(`
                            <div class="col-md-12 mb-4">
                                <div class="card d-flex flex-row">
                                    <img src="/storage/${product.image_path || 'placeholder.png'}" class="card-img-left" alt="${product.name}" style="width: 150px; height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">${product.name}</h5>
                                        <p class="card-text" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden; text-overflow: ellipsis;">${product.description}</p>
                                        <p class="card-text"><strong>Price: $${product.price}</strong></p>
                                        <a href="#" class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        `);
                            });
                        } else {
                            $('#product-list').append('<p>No products found in this category.</p>');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            });
        });



    </script>
@endsection

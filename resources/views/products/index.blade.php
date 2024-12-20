@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
{{--                <th>Slug</th>--}}
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        <img src="{{ $product->getFirstMediaUrl('products', 'thumb') }}" alt="{{ $product->name }}" style="width: 100px; height: auto;">
                    </td>
                    <td>{{ $product->name }}</td>
{{--                    <td>{{ $product->slug }}</td>--}}
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
    </div>
@endsection

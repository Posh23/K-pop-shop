<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View|Factory|Application
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create(): View|Factory|Application
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:products|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::query()->create($request->except('image'));

        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('products');
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View|Factory|Application
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View|Factory|Application
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:products,slug,' . $product->id,
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->update($request->except('image'));

        if ($request->hasFile('image')) {
            $product->clearMediaCollection('products');
            $product->addMediaFromRequest('image')
                ->toMediaCollection('products');
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function getProductsByCategory($id): JsonResponse
    {
        $products = Product::query()->where('category_id', $id)->with('category')->get();
        return response()->json($products);
    }

    public function catalog()
    {
        $categories = Category::all(); // Получаем все категории
        $products = Product::with('category')->get(); // Загружаем продукты с категориями
        return view('products.catalog', compact('products', 'categories'));
    }
}

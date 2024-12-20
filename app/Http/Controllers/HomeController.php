<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController
{
    public function index(): Application|Factory|View
    {
        $popularProducts = Product::query()->inRandomOrder()->take(8)->get();

        $categories = Category::all();

        return view('home', compact('popularProducts', 'categories'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('index', compact('products'));
    }
    public function categories()
    {
        $categories = Category::get();
        return view('categories', ['categories' => $categories]);
    }

    public function category($code)
    {
        $data = Category::where('code', $code)->first();
        return view('category', ['category' => $data]);
    }

    public function product($category, $product = null)
    {
        return view('product', ['product' => $product, 'category' => $category]);
    }
}

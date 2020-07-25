<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return new ProductResource($products);
    }

    public function getByCategory($id)
    {
        $products = Product::where('category_id', $id)->get();
        return new ProductResource($products);
    }

    // slider
    public function slider()
    {
        $products = Product::where('recommended', true)->get();
        return new ProductResource($products);
    }

    
}

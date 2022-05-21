<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductCollection(Product::paginate(15)); 
    }

    public function show($id)
    {
        return new ProductResource(Cache::remember("product_$id", 60*60*24, function($id = 48) {
            Product::findOrFail($id);
        }));
    }
}

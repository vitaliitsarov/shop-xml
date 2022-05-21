<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Http\Resources\ProductResource;

use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::paginate(15)) 
    }

    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }
}

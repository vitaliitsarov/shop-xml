<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }
}

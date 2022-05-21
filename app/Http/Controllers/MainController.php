<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select([
            Product::COLUMN_ID, 
            Product::COLUMN_TITLE, 
            Product::COLUMN_PRICE_BRUTTO, 
            Product::COLUMN_IMAGES
        ])->orderBy('id')->paginate(15);
        
        return view('main', [
            'products' => $products
        ]);
    }

        
    /**
     * contact
     *
     * @return void
     */
    public function contact()
    {
        return view('contact');
    }
}

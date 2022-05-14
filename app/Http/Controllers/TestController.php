<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;


use Tightenco\Collect\Support\Collection;
use Rodenastyle\StreamParser\StreamParser;


class TestController extends Controller
{
    
    
    public function index()
    {
        $file = Storage::get('http://ombero.pl/templates/images/products/15322/ec62c7bea6d8610ce602f021857501ad.jpg');
        Storage::put($file, 'products/15322/ec62c7bea6d8610ce602f021857501ad.jpg');

        die();
        
        StreamParser::xml(storage_path('app/public/export/36d18934f6ab856fcbd8572d81c96deb.xml'))->each(function(Collection $xml){
            $id_provider    = (int) $xml->get('ID');
            $price_netto    = str_replace(",", ".", $xml->get('Cenanettoproduktu'));
            $price_brutto   = str_replace(",", ".", $xml->get('Cenabruttoproduktu'));
            $title          = (string) $xml->get('Nazwaproduktu');
            $vat            = $xml->get('Wartopodatku');
            $status         = true;
            $barcode        = $xml->get('Kodkreskowy');
            $stock          = $xml->get('Stanmagazynowany');
            $original_url   = $xml->get('AdresURLdoproduktu');
            $description    = htmlspecialchars($xml->get('Penlyopis'), ENT_QUOTES);
            $category       = (string) $xml->get('Sciezkakategorii');
            $images         = (string) $xml->get('AdresURLzdjciaproduktu');

            $product = Product::where('id_provider', $id_provider)->first();

            if(is_null($product)) {
                $productNew = new Product;
                $productNew->id_provider    = $id_provider;
                $productNew->price_netto    = $price_netto;
                $productNew->price_brutto   = $price_brutto;
                $productNew->title          = $title;
                $productNew->vat            = $vat;
                $productNew->status         = $status;
                $productNew->barcode        = $barcode;
                $productNew->stock          = $stock;
                $productNew->original_url   = $original_url;
                $productNew->description    = $description;
                
                // Images
                $images_new = explode('*', $images);

                foreach($images_new as $key_image => $value_image) {
                    Storage::copy('http://ombero.pl/templates/images/products/15322/ec62c7bea6d8610ce602f021857501ad.jpg', 'products/15322/ec62c7bea6d8610ce602f021857501ad.jpg');
                }

                $productNew->save();
                // $category_explode = explode('/', $category);
                // foreach($category_explode as $key_category => $value_category) {
                //     if($key_category === 0) {
                //         $category_id = Category::firstOrCreate([
                //             'category' => $value_category,
                //             'parent_id' => 0
                //         ]);
                //     } else {

                //     }
                // }
            } else {
                $product->price_netto   = $price_netto;
                $product->price_brutto  = $price_brutto;
                $product->stock         = $stock;
                $product->save();
            }

        });

    }
}

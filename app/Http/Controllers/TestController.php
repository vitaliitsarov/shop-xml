<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;


use Tightenco\Collect\Support\Collection;
use Rodenastyle\StreamParser\StreamParser;
use Intervention\Image\ImageManagerStatic as Image;

class TestController extends Controller
{
    
    
    public function index()
    {
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
                $productNew->setIdProvider($id_provider)
                    ->setNetto($price_netto)
                    ->setBrutto($price_brutto)
                    ->seTitle($title)
                    ->setVat($vat)
                    ->setStatus($status)
                    ->setBarcode($barcode)
                    ->setStock($stock)
                    ->setOriginalUrl($original_url)
                    ->setDescription($description);

                // Images
                $images_json = [];
                Storage::makeDirectory("public/products/$id_provider");

                $images_new = explode('*', $images);
                foreach($images_new as $key_image => $value_image) {
                    $filename = basename($value_image);
                    // Image::make($value_image)->save(storage_path("app/public/products/$id_provider/$filename"));
                    $images_json[] = "/storage/products/$id_provider/$filename";
                }
                $productNew->setImages($images_json);

                // Category
                $categories = [];
                
                $category_explode = explode('/', $category);
                foreach($category_explode as $key_category => $value_category) {
                    if($key_category === 0) {
                        $parent = Category::firstOrCreate([
                            'title' => $value_category,
                            'parent_id' => 0
                        ]);

                        $categories[] = $parent['id'];
                    } else {
                        $chaild = Category::firstOrCreate([
                            'title' => $value_category,
                            'parent_id' => $categories[array_key_last($categories)]
                        ]);
                        $categories[] = $chaild['id'];
                    }
                }

                // Save
                $productNew->save();
            } else {
                $product->setNetto($price_netto)
                    ->setBrutto($price_brutto)
                    ->setStock($stock);
                $product->save();
            }
        });

    }
}

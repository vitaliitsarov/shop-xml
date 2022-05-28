<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use Tightenco\Collect\Support\Collection;
use Rodenastyle\StreamParser\StreamParser;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Arr;

class ParseXmlHurt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:xml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parsing products with Ombero.pl';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        StreamParser::xml(storage_path('app/public/export/36d18934f6ab856fcbd8572d81c96deb.xml'))->each(function(Collection $xml){
            $data = [
                'id_provider'    => (int) $xml->get('ID'),
                'price_netto'    => str_replace(",", ".", $xml->get('Cenanettoproduktu')),
                'price_brutto'   => str_replace(",", ".", $xml->get('Cenabruttoproduktu')),
                'title'          => (string) $xml->get('Nazwaproduktu'),
                'vat'            => $xml->get('Wartopodatku'),
                'status'         => true,
                'barcode'        => $xml->get('Kodkreskowy'),
                'stock'          => $xml->get('Stanmagazynowany'),
                'original_url'   => $xml->get('AdresURLdoproduktu'),
                'description'    => htmlspecialchars($xml->get('Penlyopis'), ENT_QUOTES),
                'category'       => (string) $xml->get('Sciezkakategorii'),
                'images'         => (string) $xml->get('AdresURLzdjciaproduktu'),
            ];
          
            $product = Product::where(
                Product::COLUMN_ID_PROVIDER, Arr::get($data, 'id_provider'
            ))->first();

            if(is_null($product)) {
                // Create new product
                $productNew = new Product;
                $productNew->setIdProvider(Arr::get($data, 'id_provider'))
                            ->setNetto(Arr::get($data, 'price_netto'))
                            ->setBrutto(Arr::get($data, 'price_brutto'))
                            ->seTitle(Arr::get($data, 'title'))
                            ->setVat(Arr::get($data, 'vat'))
                            ->setStatus(Arr::get($data, 'status'))
                            ->setBarcode(Arr::get($data, 'barcode'))
                            ->setStock(Arr::get($data, 'stock'))
                            ->setOriginalUrl(Arr::get($data, 'original_url'))
                            ->setDescription(Arr::get($data, 'description'));

                // Images
                $productNew->setImages(self::saveImages($data));

                // Category
                $productNew->setCategory(self::createCategory($data));

                // Save
                $productNew->save();
            } else {
                $product->setNetto(Arr::get($data, 'price_netto'))
                    ->setBrutto(Arr::get($data, 'price_brutto'))
                    ->setStock(Arr::get($data, 'stock'));
                $product->save();
            }
        });

        return 1;
    }

    /**
     * saveImages
     *
     * @param  mixed $data
     * @return array
     */
    private function saveImages(array $data): array
    {
        $images_json = collect();
        $id_provider = Arr::get($data, 'id_provider');
        Storage::makeDirectory("public/products/$id_provider");

        $images_new = explode('*', Arr::get($data, 'images'));
        foreach($images_new as $key_image => $value_image) {
            $filename = basename($value_image);
            Image::make($value_image)->save(storage_path("app/public/products/$id_provider/$filename"));
            $images_json->put($key_image, "/storage/products/$id_provider/$filename");
        }

        return $images_json->all();
    }
    
    /**
     * createCategory
     *
     * @param  mixed $data
     * @return int
     */
    private function createCategory(array $data): int
    {
        $categories = collect();
                
        $category_explode = explode('/', Arr::get($data, 'category'));

        foreach($category_explode as $key_category => $value_category) {
            if($key_category === 0) {
                $parent = Category::firstOrCreate([
                    'title' => $value_category,
                    'parent_id' => 0
                ]);
                $categories->put($parent['id'], $parent['id']);
            } else {
                $chaild = Category::firstOrCreate([
                    'title' => $value_category,
                    'parent_id' => $categories->last()
                ]);
                $categories->put($chaild['id'], $chaild['id']);
            }
        }

        return $categories->all();
    }
}

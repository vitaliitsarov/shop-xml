<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;

class ParseXmlHurt extends Command
{
    private $url = "http://ombero.redcart.pl/export/36d18934f6ab856fcbd8572d81c96deb.xml";
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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
     
        $xmlfile = storage_path('app/public/export/36d18934f6ab856fcbd8572d81c96deb.xml');
        
        $xmlObject = simplexml_load_string($xmlFile);
		
        $jsonFormatData = json_encode($xmlObject);
        $result = json_decode($jsonFormatData, true); 

        dd($array);
        // Product::firstOrCreate([
        //     'id_provider' => 
        // ]);

        return 0;
    }
}

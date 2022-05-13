<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        // if() {

        // }

        return 0;
    }
}

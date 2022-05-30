<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiToken;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\Table;

class CreateTokenApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create token to api.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apitoken = new ApiToken;
        
        $apitoken->setToken((string) Str::uuid())->setStatus(true);
        $apitoken->save();

        $this->newLine(2);
        $this->question("The token has been successfully created!");

        $table = new Table($this->output);

        $table->setHeaders([
            'Token', 'Status'
        ]);
        $table->setRows([
            [$apitoken->getToken(), $apitoken->getStatus() ? 'Active' : 'Not active']
        ]);
        $table->render();

        $this->newLine(2);

        return 1;
    }
}

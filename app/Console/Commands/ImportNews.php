<?php

namespace App\Console\Commands;

use App\Services\NewsHandler;
use Illuminate\Console\Command;

class ImportNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adding News to the Database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        NewsHandler::insert();
        $this->info('Adding News Successful !');
    }
}

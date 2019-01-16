<?php

namespace App\Console\Commands;

use App\Services\CarService;
use Illuminate\Console\Command;
use Cache;

class UpdateModelList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        echo("update");
        $result = CarService::getModellist();
        Cache::put("model_list", json_encode($result), 600);
    }
}

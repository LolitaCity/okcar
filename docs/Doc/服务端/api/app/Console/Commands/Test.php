<?php

namespace App\Console\Commands;

use App\Library\SendSMS;
use App\Models\AppearanceDecoration;
use App\Models\BrandInfo;
use App\Models\ModelInfo;
use App\Models\PublishInfo;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

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
        //$cos = new COS();
        //$url = $cos->upload(base_path('test.png'), 'car/abc123.png');
        //var_dump($url);


        // SendSMS::sendcode( "17688955926","1234");

        $publishId = 1;
        $info = PublishInfo::with(['modelInfo', 'salerUser'])->where('id' , 1)->get();
        var_dump($info->toArray());

    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\RouterService;
use Illuminate\Support\Str;

class DataGenerator extends Command
{
    protected $service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:data {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data Generator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RouterService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dataCount = $this->argument('count');
        $count = 1;
        $err = 0;
        
        while ($count <= $dataCount) {
            $data = array();
            
            try {
                $data["domain"] = "example-".strtolower(Str::random(10)).".com";
                $data["loopback"] = rand(1, 99).".".rand(1, 99).".".rand(1, 99).".".rand(1, 99);
                $data["mac"] = strtoupper(Str::random(2)).":".strtoupper(Str::random(2)).":".rand(1, 10).":9A:".strtoupper(Str::random(2)).":".rand(1, 10);
                
                try {
                    $inserted = $this->service->store($data);
                    if(isset($inserted->id)){
                        $count++; 
                    }
                } catch (\Throwable $th) {
                    // throw $th;
                    $err++;
                }
            } catch (Exception $e) {
                // echo 'Message: ' .$e->getMessage();
            }
        }
        $count--;
        echo "$count Row Added.";
    }
}

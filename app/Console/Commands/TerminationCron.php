<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
class TerminationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'termination:cron';

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
     */
    public function handle()
    {
        try {
            $data = [
            'branch_id' => config('constants.branch_id')
            ];
            $url = config('constants.api.termination_student');
       		$response = Http::post($url, $data);
		    Log::info("termination IS WORKING");
           	return $response->json();
           
        } catch (Exception $e) {
            Log::error("HTTP request failed to $url", [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);

            return null;
        }


    }
}

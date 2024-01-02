<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
        // \Log::info("Cron is working fine!");
        $data = [
            'branch_id' => session()->get('branch_id')
        ];
        $url = config('constants.api.termination_student');
        $response = Http::post($url, $data);
        return $response->json();
        //
    }
}

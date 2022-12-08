<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ResetExpirePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset_expire_password:cron';

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
     * @return int
     */
    public function handle()
    {
        $data = [
            'url' => env('APP_URL'),
            'branch_id' => session()->get('branch_id')
        ];
        $url = config('constants.api.reset_password_expired_link');
        $response = Http::post($url, $data);
        return $response->json();
        // \Log::info("Cron is working fine!");
        // return Command::SUCCESS;
    }
}

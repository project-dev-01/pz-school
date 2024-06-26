<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;


class CheckPublishNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bulletin:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for bulletin board that are now published';

    /**
     * Execute the console command.
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
        $this->info('Executing bulletin:cron command...');
        try {
            $secretKey = config('constants.cron_secret_key');
            $branchId = config('constants.branch_id');
            $parent_url = config('constants.api.parent_login');
            $payload = [
                'branch_id' => $branchId,
                'secret_key' => $secretKey, // Include the secret key in the payload
                'parent_url'=> $parent_url
            ];
            $url = config('constants.api.bulletin_board_cronJob');
            $response = Http::post($url, $payload);
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

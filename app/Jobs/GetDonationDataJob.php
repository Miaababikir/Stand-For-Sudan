<?php

namespace App\Jobs;

use App\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetDonationDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get('https://standforsudan.ebs-sd.com/StandForSudan/getStandForSudanStatstics')->json();

        if ($response['numberOfTransaction'] != Donation::all()->last()->transaction_id) {
            Donation::create([
                'transaction_id' => $response['numberOfTransaction'],
                'total_amount' => $response['totalAmount']
            ]);
        }

    }
}

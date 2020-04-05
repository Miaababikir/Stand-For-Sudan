<?php

namespace Tests\Feature;

use App\Donation;
use App\Jobs\GetDonationDataJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DonationCronTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
     public function can_get_donation_from_api_and_save_it()
    {
        Donation::create([
            'transaction_id' => 0,
            'total_amount' => 0
        ]);

        dispatch(new GetDonationDataJob());

        $this->assertNotEquals(0, Donation::count());

    }

}

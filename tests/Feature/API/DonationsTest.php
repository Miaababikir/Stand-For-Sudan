<?php

namespace Tests\Feature\API;

use App\Donation;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DonationsTest extends TestCase
{

    use RefreshDatabase;

    /**
    * @test
    */
     public function can_get_all_donations()
    {
        $this->withoutExceptionHandling();

        $firstDonation = factory(Donation::class)->create(['total_amount' => 100, 'created_at' => Carbon::yesterday()]);
        $secondDonation = factory(Donation::class)->create(['total_amount' => 200, 'created_at' => Carbon::now()->subHour()]);
        $lastDonation = factory(Donation::class)->create(['total_amount' => 500]);

        $response = $this->get('/api/donations')->assertSuccessful();

        $this->assertEquals(3, count($response->json()['donations']));

        $this->assertEquals(500, $response->json()['donations_total']);

        $this->assertEquals($lastDonation->total_amount - $secondDonation->total_amount, $response->json()['last_donation']);

        $this->assertEquals(2, $response->json()['today_total_donators']);


    }

}

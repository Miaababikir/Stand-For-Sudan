<?php

namespace Tests\Feature\API;

use App\Donation;
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

        $donations = factory(Donation::class, 5)->create();

        $response = $this->get('/api/donations')->assertSuccessful();

        $this->assertEquals($donations->count(), count($response->json()['data']['donations']));
    }

}

<?php

use App\Donation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Donation::create(['transaction_id' => 0, 'total_amount' => 0]);
    }
}

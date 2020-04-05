<?php

namespace App\Http\Controllers\API;

use App\Donation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->take(100)->get();

        return response()->json([ 'data' => [
            'donations' => $donations,
            'last_donation' => $donations->last(),
        ]]);
    }
}

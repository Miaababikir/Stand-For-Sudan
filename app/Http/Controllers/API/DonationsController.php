<?php

namespace App\Http\Controllers\API;

use App\Donation;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->take(10)->get();
        $latest = $donations->first();
        $donations_total = $latest->total_amount;
        $last_donation = $latest->total_amount - Donation::find($latest->id - 1)->total_amount;

        return response()->json([
            'donations' => $donations,
            'donations_total' => $donations_total,
            'last_donation' => $last_donation,
            'today_total_donators' => Donation::whereDate('created_at', Carbon::today())->count(),
        ]);
    }
}

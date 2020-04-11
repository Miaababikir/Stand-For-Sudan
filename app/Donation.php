<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $guarded = [];

    protected $appends = ['donation'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getDonationAttribute()
    {
        if ($this->id - 1 === 0)
            return $this->total_amount;

        return $this->total_amount - Donation::find($this->id - 1)->total_amount;
    }
}

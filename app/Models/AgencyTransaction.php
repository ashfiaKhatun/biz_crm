<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'refills_id',
        'cl_rate',
        'refill_usd',
        'refill_tk',
        'refill_act_usd',
        'refill_act_tk',
        'agency_charge_type',
        'agency_charge',
    ];

    public function refill()
    {
        return $this->belongsTo(Refill::class, 'refills_id');
    }
}

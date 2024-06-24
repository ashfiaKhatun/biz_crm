<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AgencyTransaction extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'refills_id',
        'cl_rate',
        'refill_usd',
        'refill_tk',
        'refill_act_usd',
        'refill_act_tk',
        'agency_charge_type',
        'agency_charge',
        'agency_rate',
    ];

    public function refill()
    {
        return $this->belongsTo(Refill::class, 'refills_id');
    }
}

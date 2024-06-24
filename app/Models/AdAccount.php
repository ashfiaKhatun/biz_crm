<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdAccount extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'client_id',
        'ad_acc_name',
        'bm_id',
        'fb_link1',
        'fb_link2',
        'fb_link3',
        'fb_link4',
        'fb_link5',
        'domain1',
        'domain2',
        'domain3',
        'agency_id',
        'ad_acc_type',
        'dollar_rate',
        'status',
        'ad_acc_id',
        'assign',
        'isActive',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function agency()
    {
        return $this->belongsTo(Agencies::class, 'agency_id');
    }
    public function refills()
    {
        return $this->hasMany(Refill::class, 'ad_account_id');
    }
}

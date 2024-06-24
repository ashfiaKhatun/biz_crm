<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Agencies extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'agency_name',
        'location',
        'commission_type',
        'dollar_rate',
        'percentage_rate',
        'ad_account_type'
    ];

    public function adAccounts()
    {
        return $this->hasMany(AdAccount::class, 'agency_id');
    }
}

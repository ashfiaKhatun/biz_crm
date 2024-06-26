<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Refill extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'client_id',
        'ad_account_id',
        'amount_taka',
        'amount_dollar',
        'payment_method',
        'transaction_id',
        'screenshot',
        'status',
        'sent_to_agency',
        'assign',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function adAccount()
    {
        return $this->belongsTo(AdAccount::class, 'ad_account_id');
    }

    public function agencyTransactions()
    {
        return $this->hasMany(AgencyTransaction::class, 'refills_id');
    }
}

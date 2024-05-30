<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refill extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'ad_account_id',
        'amount_taka',
        'amount_dollar',
        'payment_method',
        'transaction_id',
        'screenshot',
        'status', // Add status to fillable fields
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function adAccount()
    {
        return $this->belongsTo(AdAccount::class, 'ad_account_id');
    }
}

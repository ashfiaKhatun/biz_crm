<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Deposit extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'name',
        'amount_usd',
        'rate_bdt',
        'amount_bdt',
        'status',
    ];
}

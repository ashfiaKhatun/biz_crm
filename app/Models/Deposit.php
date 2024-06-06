<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount_usd',
        'rate_bdt',
        'amount_bdt',
        'status',
    ];
}

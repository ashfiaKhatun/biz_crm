<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'running_balance',
        'remaining_balance',
        'total_balance',
    ];
}

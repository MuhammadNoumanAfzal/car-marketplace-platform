<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeInRequest extends Model
{
    protected $fillable = [
        'current_vehicle_year',
        'current_make',
        'current_model',
        'current_trim',
        'current_mileage',
        'current_vin',
        'trade_payoff',
        'desired_vehicle',
        'budget_range',
        'purchase_timeline',
        'condition_notes',
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'state',
    ];
}

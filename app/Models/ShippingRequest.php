<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'vehicle_year',
        'vehicle_make',
        'vehicle_model',
        'origin',
        'destination',
        'transport_type',
        'pickup_window',
        'notes',
    ];
}

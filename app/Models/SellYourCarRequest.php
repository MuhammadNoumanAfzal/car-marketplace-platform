<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellYourCarRequest extends Model
{
    protected $fillable = [
        'vehicle_year',
        'make',
        'model',
        'trim',
        'exterior_color',
        'interior_color',
        'cylinders',
        'liters',
        'mileage',
        'transmission',
        'lien_holder',
        'additional_options',
        'first_name',
        'last_name',
        'address',
        'city',
        'state',
        'zip',
        'email',
        'phone',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'is_featured',
        'year',
        'make',
        'model',
        'trim',
        'price',
        'doc_fee',
        'filing_fee',
        'tag_fee',
        'mileage',
        'stock',
        'vin',
        'engine',
        'transmission',
        'drivetrain',
        'exterior',
        'interior',
        'fuel',
        'main_image',
        'gallery',
        'description',
        'features',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'gallery' => 'array',
        'features' => 'array',
        'price' => 'decimal:2',
        'doc_fee' => 'decimal:2',
        'filing_fee' => 'decimal:2',
        'tag_fee' => 'decimal:2',
        'year' => 'integer',
    ];

    public function getTotalPriceAttribute(): float
    {
        return (float) ($this->price ?? 0)
            + (float) ($this->doc_fee ?? 0)
            + (float) ($this->filing_fee ?? 0)
            + (float) ($this->tag_fee ?? 0);
    }
}

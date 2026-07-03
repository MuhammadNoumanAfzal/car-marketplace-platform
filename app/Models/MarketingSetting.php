<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingSetting extends Model
{
    protected $fillable = [
        'meta_pixel_id',
        'google_tag_id',
        'tiktok_pixel_id',
        'snapchat_pixel_id',
        'pinterest_tag_id',
        'linkedin_partner_id',
        'custom_head_scripts',
        'custom_body_scripts',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'site_title',
        'default_meta_title',
        'default_meta_description',
        'default_meta_keywords',
        'canonical_base_url',
        'google_search_console_verification',
        'bing_webmaster_verification',
        'google_analytics_measurement_id',
        'default_og_image',
        'business_name',
        'business_phone',
        'business_email',
        'business_address',
        'robots_directive',
        'enable_indexing',
    ];

    protected $casts = [
        'enable_indexing' => 'boolean',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(
            ['id' => 1],
            [
                'site_title' => 'Nitro Motors USA',
                'default_meta_title' => 'Nitro Motors USA | Premium Car Marketplace',
                'default_meta_description' => 'Browse modern, performance-focused inventory at Nitro Motors USA.',
                'canonical_base_url' => config('app.url'),
                'business_name' => 'Nitro Motors USA',
                'business_phone' => '+1 (305) 555-0147',
                'business_email' => 'nitroo@gmail.com',
                'business_address' => '1450 NW 79th Avenue, Miami, FL',
                'robots_directive' => 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1',
                'enable_indexing' => true,
            ]
        );
    }
}

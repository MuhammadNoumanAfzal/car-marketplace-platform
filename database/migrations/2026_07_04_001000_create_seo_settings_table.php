<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('default_meta_title')->nullable();
            $table->text('default_meta_description')->nullable();
            $table->text('default_meta_keywords')->nullable();
            $table->string('canonical_base_url')->nullable();
            $table->string('google_search_console_verification')->nullable();
            $table->string('bing_webmaster_verification')->nullable();
            $table->string('google_analytics_measurement_id')->nullable();
            $table->string('default_og_image')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_phone')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_address')->nullable();
            $table->string('robots_directive')->nullable();
            $table->boolean('enable_indexing')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marketing_settings', function (Blueprint $table) {
            $table->id();
            $table->string('meta_pixel_id')->nullable();
            $table->string('google_tag_id')->nullable();
            $table->string('tiktok_pixel_id')->nullable();
            $table->string('snapchat_pixel_id')->nullable();
            $table->string('pinterest_tag_id')->nullable();
            $table->string('linkedin_partner_id')->nullable();
            $table->longText('custom_head_scripts')->nullable();
            $table->longText('custom_body_scripts')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marketing_settings');
    }
};

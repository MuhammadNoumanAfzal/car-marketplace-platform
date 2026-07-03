<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 120);
            $table->string('phone', 30);
            $table->string('vehicle_year', 10);
            $table->string('vehicle_make', 80);
            $table->string('vehicle_model', 80);
            $table->string('origin', 120);
            $table->string('destination', 120);
            $table->string('transport_type', 60);
            $table->string('pickup_window', 60);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('email');
            $table->index('transport_type');
            $table->index('pickup_window');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_requests');
    }
};

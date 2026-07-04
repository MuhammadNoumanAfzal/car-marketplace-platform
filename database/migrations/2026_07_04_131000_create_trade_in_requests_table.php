<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trade_in_requests', function (Blueprint $table) {
            $table->id();
            $table->string('current_vehicle_year', 10);
            $table->string('current_make', 80);
            $table->string('current_model', 80);
            $table->string('current_trim', 80)->nullable();
            $table->string('current_mileage', 30);
            $table->string('current_vin', 80)->nullable();
            $table->string('trade_payoff', 50)->nullable();
            $table->string('desired_vehicle', 150)->nullable();
            $table->string('budget_range', 80)->nullable();
            $table->string('purchase_timeline', 80)->nullable();
            $table->text('condition_notes')->nullable();
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('email', 120);
            $table->string('phone', 30);
            $table->string('city', 80)->nullable();
            $table->string('state', 80)->nullable();
            $table->timestamps();

            $table->index('email', 'trade_in_requests_email_idx');
            $table->index(['current_vehicle_year', 'current_make', 'current_model'], 'trade_in_vehicle_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trade_in_requests');
    }
};

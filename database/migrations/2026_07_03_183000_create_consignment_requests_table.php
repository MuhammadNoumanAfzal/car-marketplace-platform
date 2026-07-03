<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consignment_requests', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_year', 10);
            $table->string('make', 80);
            $table->string('model', 80);
            $table->string('trim', 80)->nullable();
            $table->string('exterior_color', 50)->nullable();
            $table->string('interior_color', 50)->nullable();
            $table->string('cylinders', 20)->nullable();
            $table->string('liters', 20)->nullable();
            $table->string('mileage', 30);
            $table->string('transmission', 40);
            $table->string('lien_holder', 120)->nullable();
            $table->text('additional_options')->nullable();
            $table->string('first_name', 60);
            $table->string('last_name', 60);
            $table->string('address', 150);
            $table->string('city', 80);
            $table->string('state', 80);
            $table->string('zip', 20);
            $table->string('email', 120);
            $table->string('phone', 30);
            $table->timestamps();

            $table->index('email');
            $table->index(['vehicle_year', 'make', 'model']);
            $table->index('state');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consignment_requests');
    }
};

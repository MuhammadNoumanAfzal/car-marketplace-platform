<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('status', 20)->default('available');
            $table->boolean('is_featured')->default(false);
            $table->unsignedSmallInteger('year');
            $table->string('make', 80);
            $table->string('model', 120);
            $table->string('trim', 120)->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('doc_fee', 10, 2)->default(0);
            $table->decimal('filing_fee', 10, 2)->default(0);
            $table->decimal('tag_fee', 10, 2)->default(0);
            $table->unsignedInteger('mileage')->default(0);
            $table->string('stock', 80)->unique();
            $table->string('vin', 80)->nullable();
            $table->string('engine', 120)->nullable();
            $table->string('transmission', 120)->nullable();
            $table->string('drivetrain', 80)->nullable();
            $table->string('exterior', 80)->nullable();
            $table->string('interior', 80)->nullable();
            $table->string('fuel', 50)->nullable();
            $table->text('main_image')->nullable();
            $table->json('gallery')->nullable();
            $table->longText('description')->nullable();
            $table->json('features')->nullable();
            $table->timestamps();

            $table->index(['status', 'is_featured']);
            $table->index(['year', 'make', 'model']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};

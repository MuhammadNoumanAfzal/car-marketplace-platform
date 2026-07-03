<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 120);
            $table->string('phone', 30)->nullable();
            $table->string('topic', 80);
            $table->text('message');
            $table->timestamps();

            $table->index('email');
            $table->index('topic');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
    }
};

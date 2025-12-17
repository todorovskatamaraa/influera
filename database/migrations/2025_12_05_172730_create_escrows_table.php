<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('escrows', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('influencer_id')->constrained('users')->cascadeOnDelete();

            $table->unsignedInteger('amount')->nullable();
            $table->string('currency', 3)->default('EUR');

            $table->enum('status', ['pending', 'funded', 'released', 'cancelled'])->default('pending');
            $table->timestamp('funded_at')->nullable();
            $table->timestamp('released_at')->nullable();

            $table->timestamps();

            $table->unique(['job_id', 'influencer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escrows');
    }
};

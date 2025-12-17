<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('influencer_social_accounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('influencer_profile_id')
                  ->constrained('influencer_profiles')
                  ->cascadeOnDelete();

            $table->string('platform');
            $table->string('username');

            $table->unsignedBigInteger('followers')->nullable();
            $table->decimal('engagement_rate', 8, 2)->nullable();
            $table->unsignedBigInteger('average_reach')->nullable();
            $table->string('posting_frequency')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('influencer_social_accounts');
    }
};

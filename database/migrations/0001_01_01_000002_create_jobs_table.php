<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('campaign_name');
            $table->string('industry_category');
            $table->text('campaign_overview');
            $table->text('looking_for');

            $table->integer('budget_min');
            $table->integer('budget_max');
            $table->string('campaign_type');
            $table->string('influencers_needed');
            $table->string('duration');

            $table->integer('age_min');
            $table->integer('age_max');
            $table->string('gender');
            $table->string('influencer_tier');
            $table->json('niches');
            $table->string('content_tone');

            $table->string('content_amount');
            $table->json('platforms');

            $table->json('brand_values');
            $table->json('brand_tones');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('influencer_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('phone')->nullable();
            $table->string('location');

            $table->string('avatar_path')->nullable();
            $table->string('cover_path')->nullable();

            $table->string('audience_location')->nullable();
            $table->string('audience_age_range')->nullable();
            $table->string('audience_gender')->nullable();

            $table->json('niches')->nullable();
            $table->json('content_types')->nullable();
            $table->text('previous_collaborations')->nullable();
            $table->string('portfolio_url')->nullable();

            $table->json('collaboration_types')->nullable();
            $table->string('availability')->nullable();
            $table->string('content_restrictions')->nullable();
            $table->string('pricing_content_type')->nullable();
            $table->decimal('price_per_content', 10, 2)->nullable();

            $table->string('payment_method')->nullable();
            $table->string('tax_information')->nullable();
            $table->boolean('agreed_terms')->default(false);

            $table->decimal('engagement_rate', 8, 2)->nullable();
            $table->unsignedBigInteger('avg_reach')->nullable();
            $table->unsignedBigInteger('avg_impressions')->nullable();
            $table->decimal('conversion_rate', 8, 2)->nullable();
            $table->decimal('cost_per_engagement', 10, 2)->nullable();
            $table->decimal('cost_per_click', 10, 2)->nullable();
            $table->decimal('video_completion_rate', 8, 2)->nullable();
            $table->unsignedInteger('sentiment_score')->nullable();
            $table->decimal('discount_code_usage', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('influencer_profiles');
    }
};

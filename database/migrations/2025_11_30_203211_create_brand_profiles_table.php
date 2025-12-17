<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brand_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('company_name');
            $table->string('industry');
            $table->text('about');
            $table->string('website')->nullable();
            $table->string('location');

            $table->string('company_logo_path')->nullable();
            $table->string('company_cover_path')->nullable();

            $table->json('social_links')->nullable();

            $table->string('campaign_title')->nullable();
            $table->string('age_range')->nullable();
            $table->string('gender')->nullable();
            $table->string('audience_location')->nullable();
            $table->string('niche')->nullable();

            $table->enum('budget_type', ['fixed', 'range'])->nullable();
            $table->integer('budget_fixed')->nullable();
            $table->integer('budget_min')->nullable();
            $table->integer('budget_max')->nullable();

            $table->json('platforms')->nullable();
            $table->text('campaign_brief')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_profiles');
    }
};

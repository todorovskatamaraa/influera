<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $fitlife = User::where('email', 'fitlife@example.com')->first();
        $ecoWear = User::where('email', 'ecowear@example.com')->first();
        $chefMate = User::where('email', 'chefmate@example.com')->first();

        $jobs = [

            [
                'user_id' => $fitlife->id,
                'campaign_name' => 'Fitness Product Campaign',
                'industry_category' => 'Fitness',
                'campaign_overview' => 'Looking for fitness influencers to showcase our new workout equipment.',
                'looking_for' => 'Active creators with fitness-oriented audiences.',
                'budget_min' => 1000,
                'budget_max' => 2500,
                'campaign_type' => 'Product Promotion',
                'influencers_needed' => '2 influencers',
                'duration' => '2 weeks',
                'age_min' => 18,
                'age_max' => 45,
                'gender' => 'Any',
                'influencer_tier' => 'Micro',
                'niches' => ['Fitness', 'Lifestyle', 'Wellness'],
                'content_tone' => 'Energetic',
                'content_amount' => '3 posts',
                'platforms' => ['Instagram', 'TikTok'],
                'brand_values' => ['Quality', 'Innovation'],
                'brand_tones' => ['Friendly', 'Motivational'],
            ],

            [
                'user_id' => $ecoWear->id,
                'campaign_name' => 'Immunity Boost Launch',
                'industry_category' => 'Health',
                'campaign_overview' => 'Influencers in wellness, fitness, or lifestyle help us launch our anti-viral superfood gel.',
                'looking_for' => 'Creators passionate about wellness.',
                'budget_min' => 1500,
                'budget_max' => 4000,
                'campaign_type' => 'Product Launch',
                'influencers_needed' => '3 influencers',
                'duration' => '1 month',
                'age_min' => 21,
                'age_max' => 50,
                'gender' => 'Any',
                'influencer_tier' => 'Macro',
                'niches' => ['Health', 'Wellness', 'Lifestyle'],
                'content_tone' => 'Educational',
                'content_amount' => '4 posts',
                'platforms' => ['Instagram', 'Reels', 'TikTok'],
                'brand_values' => ['Healthy Living'],
                'brand_tones' => ['Professional'],
            ],

            [
                'user_id' => $chefMate->id,
                'campaign_name' => 'Travel Destination Showcase',
                'industry_category' => 'Travel',
                'campaign_overview' => 'Travel influencers needed to showcase our luxury destinations.',
                'looking_for' => 'Travel influencers with aesthetic content.',
                'budget_min' => 5000,
                'budget_max' => 15000,
                'campaign_type' => 'Travel Collaboration',
                'influencers_needed' => '2 influencers',
                'duration' => '2 months',
                'age_min' => 20,
                'age_max' => 45,
                'gender' => 'Any',
                'influencer_tier' => 'Semi-pro',
                'niches' => ['Travel', 'Aesthetic'],
                'content_tone' => 'Luxury',
                'content_amount' => '5 posts',
                'platforms' => ['Instagram', 'YouTube'],
                'brand_values' => ['Elegance'],
                'brand_tones' => ['Premium'],
            ],
        ];

        foreach ($jobs as $job) {
            $job['slug'] = Str::slug($job['campaign_name'] . '-' . uniqid());
            Job::create($job);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\InfluencerProfile;
use App\Models\InfluencerSocialAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InfluencerSeeder extends Seeder
{
    public function run(): void
    {
        $influencers = [
            [
                'name'  => 'Ana Jankova',
                'email' => 'ana@example.com',
                'location' => 'Skopje, North Macedonia',
                'avatar_path' => 'images/ana.png',
                'cover_path'  => 'images/ana.png',
                'niches' => ['Fitness', 'Wellness', 'Home Workouts'],
                'content_types' => ['Reels', 'Stories', 'TikTok videos'],
                'collaboration_types' => ['Sponsored posts', 'Affiliate', 'Product seeding'],
                'platforms' => [
                    [
                        'platform' => 'instagram',
                        'username' => 'ana.fit.life',
                        'followers' => 120000,
                        'engagement_rate' => 4.8,
                        'average_reach' => 65000,
                        'posting_frequency' => 'daily',
                    ],
                    [
                        'platform' => 'tiktok',
                        'username' => 'ana.fit.home',
                        'followers' => 80000,
                        'engagement_rate' => 5.2,
                        'average_reach' => 40000,
                        'posting_frequency' => '3x per week',
                    ],
                ],
            ],
            [
                'name'  => 'Mark Thompson',
                'email' => 'mark@example.com',
                'location' => 'London, UK',
                'avatar_path' => 'images/mark.png',
                'cover_path'  => 'images/mark.png',
                'niches' => ['Tech', 'Gadgets', 'Productivity'],
                'content_types' => ['YouTube videos', 'Shorts', 'Reviews'],
                'collaboration_types' => ['Sponsored videos', 'Affiliate', 'Long-term partnership'],
                'platforms' => [
                    [
                        'platform' => 'youtube',
                        'username' => 'MarkTechReview',
                        'followers' => 250000,
                        'engagement_rate' => 3.5,
                        'average_reach' => 150000,
                        'posting_frequency' => 'weekly',
                    ],
                    [
                        'platform' => 'instagram',
                        'username' => 'mark.tech',
                        'followers' => 90000,
                        'engagement_rate' => 3.9,
                        'average_reach' => 50000,
                        'posting_frequency' => '3x per week',
                    ],
                ],
            ],
            [
                'name'  => 'Emily Tran',
                'email' => 'emily@example.com',
                'location' => 'Berlin, Germany',
                'avatar_path' => 'images/emily.png',
                'cover_path'  => 'images/emily.png',
                'niches' => ['Sustainable Fashion', 'Lifestyle'],
                'content_types' => ['Photos', 'Reels', 'Blog posts'],
                'collaboration_types' => ['Sponsored posts', 'Brand ambassadorship'],
                'platforms' => [
                    [
                        'platform' => 'instagram',
                        'username' => 'emily.eco.style',
                        'followers' => 180000,
                        'engagement_rate' => 4.1,
                        'average_reach' => 90000,
                        'posting_frequency' => 'daily',
                    ],
                    [
                        'platform' => 'tiktok',
                        'username' => 'emily.trend',
                        'followers' => 70000,
                        'engagement_rate' => 4.6,
                        'average_reach' => 35000,
                        'posting_frequency' => '3x per week',
                    ],
                ],
            ],
        ];

        foreach ($influencers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('password'),
                    'role'     => 'influencer',
                ]
            );

            $profile = InfluencerProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone'                  => null,
                    'location'               => $data['location'],
                    'avatar_path'            => $data['avatar_path'],
                    'cover_path'             => $data['cover_path'] ?? null,
                    'audience_location'      => 'Global',
                    'audience_age_range'     => '18-34',
                    'audience_gender'        => 'mixed',
                    'niches'                 => $data['niches'],
                    'content_types'          => $data['content_types'],
                    'previous_collaborations'=> 'Multiple brand collaborations in their niche.',
                    'portfolio_url'          => null,
                    'collaboration_types'    => $data['collaboration_types'],
                    'availability'           => 'project-based',
                    'content_restrictions'   => 'No tobacco, gambling or misleading products.',
                    'pricing_content_type'   => 'Per campaign',
                    'price_per_content'      => 500,
                    'payment_method'         => 'bank_transfer',
                    'tax_information'        => 'Registered content creator',
                    'agreed_terms'           => true,
                    'engagement_rate'        => 4.00,
                    'avg_reach'              => 50000,
                    'avg_impressions'        => 120000,
                    'conversion_rate'        => 2.50,
                    'cost_per_engagement'    => 0.50,
                    'cost_per_click'         => 1.20,
                    'video_completion_rate'  => 65.00,
                    'sentiment_score'        => 85,
                    'discount_code_usage'    => 12.50,
                ]
            );

            foreach ($data['platforms'] as $platform) {
                InfluencerSocialAccount::updateOrCreate(
                    [
                        'influencer_profile_id' => $profile->id,
                        'platform'              => $platform['platform'],
                    ],
                    [
                        'username'          => $platform['username'],
                        'followers'         => $platform['followers'],
                        'engagement_rate'   => $platform['engagement_rate'],
                        'average_reach'     => $platform['average_reach'],
                        'posting_frequency' => $platform['posting_frequency'],
                    ]
                );
            }
        }
    }
}

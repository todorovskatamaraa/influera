<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InfluencerProfile;
use App\Models\InfluencerSocialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class InfluencerRegisterController extends Controller
{
    public function show()
    {
        return view('register-influence');
    }

    public function store(Request $request)
    {
        $selected = json_decode($request->input('selected_data', '{}'), true) ?? [];

        $request->merge([
            'niches'        => $selected['niches']        ?? [],
            'content_types' => $selected['content_types'] ?? [],
            'collab_types'  => $selected['collab_types']  ?? [],
        ]);

        $data = $request->validate([
            'full_name'       => ['required', 'string', 'max:255'],
            'email'           => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'        => ['required', 'string', 'min:8'],
            'phone'           => ['nullable', 'string', 'max:50'],
            'location'        => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'max:6144'],
            'profile_cover'   => ['nullable', 'image', 'max:12288'],

            'social_platforms'   => ['required', 'array', 'min:2'],
            'social_platforms.0' => ['required', 'string', 'in:instagram,tiktok,youtube'],
            'social_platforms.1' => ['required', 'string', 'in:instagram,tiktok,youtube'],
            'social_platforms.*' => ['nullable', 'string', 'in:instagram,tiktok,youtube'],
            'social_usernames'   => ['required', 'array', 'min:2'],
            'social_usernames.0' => ['required', 'string', 'max:255'],
            'social_usernames.1' => ['required', 'string', 'max:255'],
            'social_usernames.*' => ['nullable', 'string', 'max:255'],

            'followers'         => ['nullable', 'string', 'max:50'],
            'engagement_rate'   => ['nullable', 'string', 'max:50'],
            'avg_reach'         => ['nullable', 'string', 'max:50'],
            'posting_frequency' => ['nullable', 'string', 'in:daily,weekly,monthly'],

            'audience_age_range' => ['required', 'string', 'max:50'],
            'audience_gender'    => ['required', 'string', 'max:20'],
            'audience_location'  => ['required', 'string', 'max:255'],

            'niches'          => ['required', 'array', 'min:1'],
            'niches.*'        => ['string', 'max:100'],
            'content_types'   => ['required', 'array', 'min:1'],
            'content_types.*' => ['string', 'max:100'],

            'collaborations'   => ['nullable', 'array'],
            'collaborations.*' => ['nullable', 'string', 'max:255'],
            'portfolio_url'    => ['nullable', 'url', 'max:255'],

            'collab_types'         => ['required', 'array', 'min:1'],
            'collab_types.*'       => ['string', 'max:100'],
            'availability'         => ['required', 'string', 'max:50'],
            'content_restrictions' => ['nullable', 'string', 'max:500'],
            'pricing_type'         => ['nullable', 'string', 'max:50'],
            'price'                => ['nullable', 'numeric', 'min:0'],

            'payment_method' => ['required', 'string', 'in:bank,paypal,stripe'],
            'tax_id'         => ['nullable', 'string', 'max:255'],
            'agreement'      => ['required', 'in:yes'],

            'metric_engagement_rate'  => ['nullable', 'numeric'],
            'metric_avg_reach'        => ['nullable', 'numeric'],
            'metric_impressions'      => ['nullable', 'numeric'],
            'metric_conversion_rate'  => ['nullable', 'numeric'],
            'metric_cpe'              => ['nullable', 'numeric'],
            'metric_cpc'              => ['nullable', 'numeric'],
            'metric_video_completion' => ['nullable', 'numeric'],
            'metric_sentiment'        => ['nullable', 'numeric'],
            'metric_discount_usage'   => ['nullable', 'numeric'],
        ]);

        $user = null;

        DB::transaction(function () use (&$user, $data, $request) {
            $user = User::create([
                'name'     => $data['full_name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => 'influencer',
            ]);

            $avatarPath = $request->file('profile_picture')
                ? $request->file('profile_picture')->store('influencers/avatars', 'public')
                : null;

            $coverPath = $request->file('profile_cover')
                ? $request->file('profile_cover')->store('influencers/covers', 'public')
                : null;

            $collabsText = null;
            if (!empty($data['collaborations'])) {
                $collabsText = implode(', ', array_filter($data['collaborations']));
            }

            $profile = InfluencerProfile::create([
                'user_id'                 => $user->id,
                'phone'                   => $data['phone'] ?? null,
                'location'                => $data['location'],
                'avatar_path'             => $avatarPath,
                'cover_path'              => $coverPath,
                'audience_age_range'      => $data['audience_age_range'],
                'audience_gender'         => $data['audience_gender'],
                'audience_location'       => $data['audience_location'],
                'niches'                  => $data['niches'],
                'content_types'           => $data['content_types'],
                'previous_collaborations' => $collabsText,
                'portfolio_url'           => $data['portfolio_url'] ?? null,
                'collaboration_types'     => $data['collab_types'],
                'availability'            => $data['availability'],
                'content_restrictions'    => $data['content_restrictions'] ?? null,
                'pricing_content_type'    => $data['pricing_type'] ?? null,
                'price_per_content'       => $data['price'] ?? null,
                'payment_method'          => $data['payment_method'],
                'tax_information'         => $data['tax_id'] ?? null,
                'agreed_terms'            => true,
                'engagement_rate'       => $data['metric_engagement_rate']  ?? null,
                'avg_reach'             => $data['metric_avg_reach']        ?? null,
                'avg_impressions'       => $data['metric_impressions']      ?? null,
                'conversion_rate'       => $data['metric_conversion_rate']  ?? null,
                'cost_per_engagement'   => $data['metric_cpe']              ?? null,
                'cost_per_click'        => $data['metric_cpc']              ?? null,
                'video_completion_rate' => $data['metric_video_completion'] ?? null,
                'sentiment_score'       => $data['metric_sentiment']        ?? null,
                'discount_code_usage'   => $data['metric_discount_usage']   ?? null,
            ]);

            $platforms = $data['social_platforms'] ?? [];
            $usernames = $data['social_usernames'] ?? [];

            foreach ($platforms as $index => $platform) {
                $username = $usernames[$index] ?? null;
                if (!$platform || !$username) {
                    continue;
                }

                InfluencerSocialAccount::create([
                    'influencer_profile_id' => $profile->id,
                    'platform'              => $platform,
                    'username'              => $username,
                    'followers'             => $data['followers']        ?? null,
                    'engagement_rate'       => $data['engagement_rate']  ?? null,
                    'average_reach'         => $data['avg_reach']        ?? null,
                    'posting_frequency'     => $data['posting_frequency']?? null,
                ]);
            }
        });

        if (!$user instanceof User) {
            abort(500, 'Registration failed.');
        }

        Auth::login($user);

        return redirect()
            ->route('influencer-dashboard')
            ->with('success', 'Your influencer application has been submitted!')
            ->with('welcome_message', 'Welcome, ' . $user->name . '!');
    }
}

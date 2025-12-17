<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BrandProfile;
use App\Services\DnaMatchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BusinessProfileController extends Controller
{
    /**
     * PUBLIC BUSINESS PROFILE
     */
    public function showPublic(User $user)
    {
        $brand = BrandProfile::where('user_id', $user->id)->firstOrFail();

        if ($brand->company_logo_path) {
            $logoPath = ltrim($brand->company_logo_path, '/');

            if (Str::startsWith($logoPath, ['http://', 'https://', 'images/'])) {
                $logo = asset($logoPath);
            } else {
                $logo = asset('storage/' . $logoPath);
            }
        } else {
            $logo = asset('images/default-avatar.jpg');
        }

        if ($brand->company_cover_path) {
            $coverPath = ltrim($brand->company_cover_path, '/');

            if (Str::startsWith($coverPath, ['http://', 'https://', 'images/'])) {
                $cover = asset($coverPath);
            } else {
                $cover = asset('storage/' . $coverPath);
            }
        } else {
            $cover = asset('images/default-cover.jpg');
        }

        $authUser = Auth::user();

        $matchScoreLocal = null;
        $valuesMatch     = null;
        $audienceMatch   = null;
        $contentMatch    = null;
        $matchTitle      = 'No match data yet';
        $matchSubtitle   = 'Log in as an influencer to see how well you match with this brand.';
        $angle           = 0;

        if (
            $authUser &&
            $authUser->role === 'influencer' &&
            $authUser->influencerProfile
        ) {
            $dna = DnaMatchService::calculateBrandToInfluencerBreakdown(
                $brand,
                $authUser->influencerProfile
            );

            $matchScoreLocal = $dna['total']   ?? null;
            $valuesMatch     = $dna['niches']  ?? null;
            $audienceMatch   = $dna['age']     ?? null;
            $contentMatch    = $dna['gender']  ?? null;

            if (!is_null($matchScoreLocal)) {
                if ($matchScoreLocal >= 80) {
                    $matchTitle    = 'Great compatibility';
                    $matchSubtitle = 'Strong alignment across niches and audience demographics.';
                } elseif ($matchScoreLocal >= 50) {
                    $matchTitle    = 'Partial compatibility';
                    $matchSubtitle = 'There is some overlap, but not a perfect match yet.';
                } else {
                    $matchTitle    = 'Low compatibility';
                    $matchSubtitle = 'There are significant differences in audience or content focus.';
                }

                $angle = max(0, min(100, (int) $matchScoreLocal)) * 3.6;
            }
        }

        $matchBreakdown = [
            ['label' => 'Niche Match',             'value' => $valuesMatch],
            ['label' => 'Audience Age Match',      'value' => $audienceMatch],
            ['label' => 'Audience Gender Match',   'value' => $contentMatch],
        ];

        return view('business-profile-public', [
            'user'            => $user,
            'brand'           => $brand,
            'cover'           => $cover,
            'logo'            => $logo,

            'matchScoreLocal' => $matchScoreLocal,
            'matchTitle'      => $matchTitle,
            'matchSubtitle'   => $matchSubtitle,
            'angle'           => $angle,

            'matchBreakdown'  => $matchBreakdown,
            'valuesMatch'     => $valuesMatch,
            'audienceMatch'   => $audienceMatch,
            'contentMatch'    => $contentMatch,

            'matchScore'      => $matchScoreLocal,
        ]);
    }

    /**
     * PRIVATE BUSINESS PROFILE
     */
    public function showPrivate()
    {
        $user  = Auth::user();

        $brand = BrandProfile::where('user_id', $user->id)->firstOrFail();

        return view('business-profile-private', compact('user', 'brand'));
    }
}

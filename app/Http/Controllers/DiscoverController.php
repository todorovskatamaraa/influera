<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfluencerProfile;
use App\Models\BrandProfile;
use App\Services\DnaMatchService;

class DiscoverController extends Controller
{
    public function index(Request $request)
    {
        $user      = $request->user();
        $search    = $request->input('search');
        $sort      = $request->input('sort');
        $dnaActive = $request->boolean('dna');
        $dnaScore  = null;

        if (! $user) {
            $dnaActive = false;
        }

        if ($dnaActive && ! $sort) {
            $sort = 'match';
        }

        if ($sort === 'match' && $user) {
            $dnaActive = true;
        }

        // -------------------------------------------------------
        // INFLUENCERS QUERY
        // -------------------------------------------------------
        $influencersQuery = InfluencerProfile::with(['user', 'socialAccounts'])
            ->whereHas('user', function ($q) {
                $q->where('role', 'influencer');
            });

        if ($search) {
            $influencersQuery->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', '%' . $search . '%');
                    })
                  ->orWhere('bio', 'like', '%' . $search . '%')
                  ->orWhere('previous_collaborations', 'like', '%' . $search . '%');
            });
        }

        $influencers = $influencersQuery
            ->latest()
            ->get();

        // -------------------------------------------------------
        // BUSINESSES QUERY (Brands)
        // -------------------------------------------------------
        $businessesQuery = BrandProfile::with('user')
            ->whereHas('user', function ($q) {
                $q->where('role', 'brand');
            });

        if ($search) {
            $businessesQuery->where(function ($q) use ($search) {
                $q->where('company_name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%')
                  ->orWhere('industry', 'like', '%' . $search . '%')
                  ->orWhere('about', 'like', '%' . $search . '%');
            });
        }

        $businesses = $businessesQuery
            ->latest()
            ->paginate(6)
            ->withQueryString();

        // -------------------------------------------------------
        // DNA MATCH
        // -------------------------------------------------------
        if ($user && $dnaActive) {

            if ($user->role === 'brand' && $user->brandProfile) {
                $brandProfile = $user->brandProfile;

                $influencers = $influencers
                    ->map(function (InfluencerProfile $profile) use ($brandProfile) {

                        $detail = DnaMatchService::calculateBrandToInfluencerBreakdown(
                            $brandProfile,
                            $profile
                        );

                        $profile->match_score     = $detail['total'] ?? 0;
                        $profile->match_breakdown = $detail;

                        return $profile;
                    });

                $dnaScore = (int) ($influencers->max('match_score') ?? 0);

                if ($sort === 'match') {
                    $influencers = $influencers
                        ->sortByDesc('match_score')
                        ->values();
                }
            }

            if ($user->role === 'influencer' && $user->influencerProfile) {

                $influencerProfile = $user->influencerProfile;

                $collection = $businesses->getCollection()
                    ->map(function (BrandProfile $brand) use ($influencerProfile) {

                        $detail = DnaMatchService::calculateBrandToInfluencerBreakdown(
                            $brand,
                            $influencerProfile
                        );

                        $brand->match_score     = $detail['total'] ?? 0;
                        $brand->match_breakdown = $detail;

                        return $brand;
                    });

                $dnaScore = (int) ($collection->max('match_score') ?? 0);

                if ($sort === 'match') {
                    $collection = $collection
                        ->sortByDesc('match_score')
                        ->values();
                }

                $businesses->setCollection($collection);
            }
        }

        return view('discover', [
            'influencers' => $influencers,
            'businesses'  => $businesses,
            'dnaActive'   => $dnaActive,
            'dnaScore'    => $dnaScore,
            'sort'        => $sort,
        ]);
    }
}

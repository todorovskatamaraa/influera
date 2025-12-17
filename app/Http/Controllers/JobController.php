<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Services\DnaMatchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function create()
    {
        return view('create-job');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'campaign_name'      => 'required|string|max:255',
            'industry_category'  => 'required|string|max:255',
            'campaign_overview'  => 'required|string',
            'looking_for'        => 'required|string',

            'budget_min'         => 'required|integer|min:0',
            'budget_max'         => 'required|integer|min:0|gte:budget_min',
            'campaign_type'      => 'required|string|max:255',
            'influencers_needed' => 'required|string|max:255',
            'duration'           => 'required|string|max:255',

            'age_min'            => 'required|integer|min:18',
            'age_max'            => 'required|integer|min:18|gte:age_min',
            'gender'             => 'required|string|max:255',
            'influencer_tier'    => 'required|string|max:255',
            'niches'             => 'required|array|min:1',
            'niches.*'           => 'string',
            'content_tone'       => 'required|string|max:255',

            'content_amount'     => 'required|string|max:255',
            'platforms'          => 'required|array|min:1',
            'platforms.*'        => 'string',

            'brand_values'       => 'required|array|min:1|max:3',
            'brand_values.*'     => 'string',
            'brand_tones'        => 'required|array|min:1|max:2',
            'brand_tones.*'      => 'string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['slug']    = Str::slug($validated['campaign_name'] . '-' . uniqid());
        $validated['status']  = 'active';

        Job::create($validated);

        return redirect()
            ->route('business-dashboard')
            ->with('success', 'Job created successfully.');
    }

    public function index(Request $request)
{
    $jobs = Job::with(['user.brandProfile']);

    $sort      = $request->input('sort');
    $dnaFlag   = $request->boolean('dna_match');
    $dnaActive = $dnaFlag || $sort === 'match';

    /* SEARCH */
    if ($search = $request->input('search')) {
        $jobs->where(function ($q) use ($search) {
            $q->where('campaign_name', 'like', "%{$search}%")
                ->orWhere('campaign_overview', 'like', "%{$search}%")
                ->orWhereHas('user', function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%");
                });
        });
    }

    /* SORTING */
    if ($sort === 'newest' || (!$sort && ! $dnaActive)) {
        $jobs->orderBy('created_at', 'desc');
    } elseif ($sort === 'oldest') {
        $jobs->orderBy('created_at', 'asc');
    } elseif ($sort === 'price-high') {
        $jobs->orderBy('budget_min', 'desc');
    } elseif ($sort === 'price-low') {
        $jobs->orderBy('budget_min', 'asc');
    }

    /* CATEGORIES */
    $categories = (array) $request->input('categories');
    if (!empty($categories)) {
        $jobs->where(function ($q) use ($categories) {
            foreach ($categories as $cat) {
                $q->orWhereJsonContains('niches', $cat);
            }
        });
    }

    /* BUDGET */
    if ($request->filled('min_budget') || $request->filled('max_budget')) {
        $min = (int) $request->input('min_budget', 0);
        $max = (int) $request->input('max_budget', 1000000);

        $jobs->where(function ($q) use ($min, $max) {
            $q->where('budget_min', '<=', $max)
              ->where('budget_max', '>=', $min);
        });
    }

    /* CONTENT */
    $platformFilters = (array) $request->input('platforms');
    if (!empty($platformFilters)) {
        $jobs->where(function ($q) use ($platformFilters) {
            foreach ($platformFilters as $pf) {
                $q->orWhere(function ($sub) use ($pf) {
                    if ($pf === 'instagram_posts' || $pf === 'stories') {
                        $sub->whereJsonContains('platforms', 'Instagram');
                    }
                    if ($pf === 'reels_tiktok') {
                        $sub->whereJsonContains('platforms', 'Reels')
                            ->orWhereJsonContains('platforms', 'TikTok');
                    }
                });
            }
        });
    }

    /* DURATION */
    $durationGroups = (array) $request->input('duration_groups');
    if (!empty($durationGroups)) {
        $jobs->where(function ($q) use ($durationGroups) {
            foreach ($durationGroups as $group) {
                $q->orWhere(function ($sub) use ($group) {

                    if ($group === 'short-term') {
                        $sub->where('duration', 'like', '%week%');
                    } elseif ($group === 'medium-term') {
                        $sub->where('duration', 'like', '1 month%')
                            ->orWhere('duration', 'like', '%2 months%')
                            ->orWhere('duration', 'like', '%3 months%');
                    } elseif ($group === 'long-term') {
                        $sub->where('duration', 'like', '%4 months%')
                            ->orWhere('duration', 'like', '%5 months%')
                            ->orWhere('duration', 'like', '%6 months%')
                            ->orWhere('duration', 'like', '%12 months%');
                    }

                });
            }
        });
    }

    $jobs = $jobs->get();

    $user     = Auth::user();
    $dnaScore = null;

    if ($user && $user->role === 'influencer') {

        foreach ($jobs as $job) {
            $job->match_score = DnaMatchService::calculateInfluencerToJobScore($user, $job);
        }

        if ($dnaActive) {
            $jobs = $jobs->sortByDesc('match_score')->values();
        }

        if ($dnaActive) {
            $nonZero = $jobs->where('match_score', '>', 0);
            if ($nonZero->count() > 0) {
                $dnaScore = (int) $nonZero->max('match_score');
            } else {
                $dnaScore = 0;
            }
        }
    }

    return view('jobs', [
        'jobs'     => $jobs,
        'dnaScore' => $dnaScore,
    ]);
}

    public function show($slug)
    {
        $job = Job::with(['user.brandProfile'])
            ->where('slug', $slug)
            ->firstOrFail();

        $user           = Auth::user();
        $matchScore     = null;
        $matchBreakdown = null;

        if ($user && $user->role === 'influencer' && $user->influencerProfile) {

            $raw = DnaMatchService::calculateInfluencerToJobBreakdown($user, $job);

            $matchScore =
                $raw['total'] ??
                $raw['score'] ??
                $raw['match'] ??
                null;

            $nicheMatch =
                $raw['niche_match'] ??
                $raw['niche'] ??
                $raw['niches'] ??
                null;

            $ageMatch =
                $raw['age_match'] ??
                $raw['age'] ??
                $raw['audience'] ??
                null;

            $genderMatch =
                $raw['gender_match'] ??
                $raw['gender'] ??
                null;

            $matchBreakdown = [
                'niche'  => $nicheMatch,
                'age'    => $ageMatch,
                'gender' => $genderMatch,
            ];
        }

        

        return view('job-details', [
            'job'            => $job,
            'matchScore'     => $matchScore,
            'matchBreakdown' => $matchBreakdown,
        ]);


    }
}

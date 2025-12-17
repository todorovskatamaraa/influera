<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LeaderboardController extends Controller
{
    public function index()
    {
        $topInfluencers = User::where('role', 'influencer')
            ->with(['ratingsReceived', 'jobApplications', 'influencerProfile'])
            ->get()
            ->map(function ($user) {

                $avgRating = $user->ratingsReceived->avg('score') ?? 0;

                $completedJobs = $user->jobApplications
                    ->where('status', 'accepted')
                    ->count();

                $score = ($avgRating * 20) + ($completedJobs * 5);

                $profile = $user->influencerProfile;

                $avatarPath = $profile?->avatar_path;
                $avatar = asset('images/default-avatar.jpg');

                if ($avatarPath) {
                    if (Str::startsWith($avatarPath, ['http://', 'https://'])) {
                        $avatar = $avatarPath;
                    } elseif (Storage::disk('public')->exists($avatarPath)) {
                        $avatar = Storage::url($avatarPath);
                    } else {
                        $avatar = asset($avatarPath);
                    }
                }

                $primaryNiche = $profile && $profile->niches
                    ? collect($profile->niches)->filter()->take(2)->implode(', ')
                    : null;

                return [
                    'user'           => $user,
                    'profile'        => $profile,
                    'avatar'         => $avatar,
                    'location'       => $profile?->location ?? 'Location not set',
                    'primary_niche'  => $primaryNiche,
                    'avg_rating'     => round($avgRating, 1),
                    'completed_jobs' => $completedJobs,
                    'score'          => $score,
                ];
            })
            ->sortByDesc('score')
            ->values()
            ->take(20);

        return view('leaderboard', compact('topInfluencers'));
    }
}

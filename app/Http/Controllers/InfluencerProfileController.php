<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use App\Models\PortfolioItem;
use Illuminate\Support\Facades\Auth;

class InfluencerProfileController extends Controller
{
    public function showPrivate()
    {
        return $this->index();
    }

    public function showPublic(User $user)
    {
        return $this->public($user);
    }

    public function index()
    {
        $user    = Auth::user();
        $profile = $user->influencerProfile;

        $pendingApplicationsCount = JobApplication::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $dnaScore = 0;

        if ($profile) {
            $dnaScore = $profile->calculateDnaScore();
        }

        $portfolioItems = PortfolioItem::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('influencer-profile-private', [
            'authUser'                 => $user,
            'profile'                  => $profile,
            'dnaScore'                 => $dnaScore,
            'pendingApplicationsCount' => $pendingApplicationsCount,
            'portfolioItems'           => $portfolioItems,
        ]);
    }
    
    public function public(User $user)
    {
        $profile  = $user->influencerProfile;
        $dnaScore = 0;

        if ($profile) {
            $dnaScore = $profile->calculateDnaScore();
        }

        $portfolioItems = PortfolioItem::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('influencer-profile-public', [
            'authUser'       => $user,
            'profile'        => $profile,
            'dnaScore'       => $dnaScore,
            'portfolioItems' => $portfolioItems,
        ]);
    }
}

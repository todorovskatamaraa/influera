<?php

namespace App\Http\Controllers;

use App\Models\Escrow;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'brand') {
            $escrows = Escrow::with(['job.user', 'influencer'])
                ->whereHas('job', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->latest()
                ->get();

            $type = 'brand';
        } else {
            $escrows = Escrow::with(['job.user'])
                ->where('influencer_id', $user->id)
                ->latest()
                ->get();

            $type = 'influencer';
        }

        return view('finances.index', compact('escrows', 'type', 'user'));
    }
}

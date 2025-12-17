<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificationRequest;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers      = User::where('role', '!=', 'admin')->count();
        $pendingUsers    = User::where('role', '!=', 'admin')->where('status', 'pending')->count();
        $approvedUsers   = User::where('role', '!=', 'admin')->where('status', 'approved')->count();
        $rejectedUsers   = User::where('role', '!=', 'admin')->where('status', 'rejected')->count();

        $totalVerifications     = VerificationRequest::count();
        $pendingVerifications   = VerificationRequest::where('status', 'pending')->count();
        $approvedVerifications  = VerificationRequest::where('status', 'approved')->count();
        $rejectedVerifications  = VerificationRequest::where('status', 'rejected')->count();



        return view('admin.dashboard', compact(
            'totalUsers',
            'pendingUsers',
            'approvedUsers',
            'rejectedUsers',
            'totalVerifications',
            'pendingVerifications',
            'approvedVerifications',
            'rejectedVerifications'
        ));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users', compact('users'));
    }

    public function approveUser(User $user)
    {
        if ($user->role === 'admin') abort(403);

        $user->status = 'approved';
        $user->save();

        return back()->with('success', 'User approved.');
    }

    public function rejectUser(User $user)
    {
        if ($user->role === 'admin') abort(403);

        $user->status = 'rejected';
        $user->save();

        return back()->with('success', 'User rejected.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationAdminController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $verifications = VerificationRequest::with(['user', 'reviewer'])
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.verifications', compact('verifications', 'status'));
    }

    public function approve(VerificationRequest $verification)
{
    $verification->status      = 'approved';
    $verification->reviewed_by = Auth::id();
    $verification->reviewed_at = now();
    $verification->save();

    return back()->with('success', 'Verification approved.');
}

public function reject(Request $request, VerificationRequest $verification)
{
    $verification->status      = 'rejected';
    $verification->reviewed_by = Auth::id();
    $verification->reviewed_at = now();
    $verification->notes       = $request->input('notes', 'Rejected by admin.');
    $verification->save();

    return back()->with('success', 'Verification rejected.');
}

}

<?php

namespace App\Http\Controllers;

use App\Models\VerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerificationController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        $latest = $user->verificationRequests()
            ->orderByDesc('created_at')
            ->first();

        return view('account.verification', compact('user', 'latest'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'type'     => 'nullable|string|max:50',
        ]);

        $path = $request->file('document')->store('verifications', 'public');

        VerificationRequest::create([
            'user_id'       => $user->id,
            'type'          => $validated['type'] ?? 'kyc',
            'document_path' => $path,
            'status'        => 'pending',
        ]);

        return back()->with('success', 'Your verification document was submitted and is pending review.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandProfileRequest;
use App\Models\BrandProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BusinessRegisterController extends Controller
{
    public function show()
    {
        return view('register-business');
    }

    public function create()
    {
        return view('auth.register-business');
    }

    public function store(StoreBrandProfileRequest $request)
    {
        $user = null;

        DB::transaction(function () use ($request, &$user) {
            $user = User::create([
                'name'     => $request->company_name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'brand',
            ]);

            $logoPath  = $request->file('company_logo')
                ? $request->file('company_logo')->store('brand_logos', 'public')
                : null;

            $coverPath = $request->file('company_cover')
                ? $request->file('company_cover')->store('brand_covers', 'public')
                : null;

            $socialLinks = array_filter($request->input('social_links', []));

            $budgetMin   = null;
            $budgetMax   = null;
            $budgetFixed = null;

            if ($request->budget_type === 'fixed') {
                $budgetFixed = $request->budget_fixed;
            } elseif ($request->budget_type === 'range') {
                $budgetMin = $request->budget_min;
                $budgetMax = $request->budget_max;

                if ($budgetMin !== null && $budgetMax !== null && $budgetMin > $budgetMax) {
                    [$budgetMin, $budgetMax] = [$budgetMax, $budgetMin];
                }
            }

            BrandProfile::create([
                'user_id'           => $user->id,
                'company_name'      => $request->company_name,
                'industry'          => $request->industry,
                'about'             => $request->about,
                'website'           => $request->website,
                'location'          => $request->location,
                'company_logo_path' => $logoPath,
                'company_cover_path'=> $coverPath,
                'social_links'      => $socialLinks,

                'campaign_title'    => $request->campaign_title,
                'age_range'         => $request->age_range,
                'gender'            => $request->gender,
                'audience_location' => $request->audience_location,
                'niche'             => $request->niche,

                'budget_type'  => $request->budget_type,
                'budget_fixed' => $budgetFixed,
                'budget_min'   => $budgetMin,
                'budget_max'   => $budgetMax,

                'platforms'      => $request->input('platforms', []),
                'campaign_brief' => $request->campaign_brief,
            ]);
        });

        if (!$user instanceof User) {
            abort(500, 'Business registration failed.');
        }

        Auth::login($user);

        return redirect()
            ->route('business-dashboard')
            ->with('success', 'Business profile created successfully.')
            ->with('welcome_message', 'Welcome, ' . $user->name . '!');
    }
}

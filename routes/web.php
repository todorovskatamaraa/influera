<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BusinessRegisterController;
use App\Http\Controllers\InfluencerRegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\BusinessDashboardController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\InfluencerProfileController;
use App\Http\Controllers\InfluencerDashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VerificationAdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\EscrowController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\HelpController;



use App\Services\DnaMatchService;

use App\Models\User;
use App\Models\InfluencerProfile;
use App\Models\BrandProfile;
use App\Models\PortfolioItem;

// ========================
// Home
// ========================
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ========================
// Registration
// ========================
Route::prefix('register')->group(function () {

    Route::get('/', [RegisterController::class, 'show'])->name('register');

    Route::get('/business', [BusinessRegisterController::class, 'show'])->name('register-business');
    Route::post('/business', [BusinessRegisterController::class, 'store'])->name('register-business-store');

    Route::get('/influence', [InfluencerRegisterController::class, 'show'])->name('register-influence');
    Route::post('/influence', [InfluencerRegisterController::class, 'store'])->name('influencer-register-store');
});

// ========================
// Login
// ========================
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::post('/check-email', function (\Illuminate\Http\Request $request) {
    $exists = \App\Models\User::where('email', $request->email)->exists();
    return response()->json(['exists' => $exists]);
})->name('check-email');


// ========================
// Influencer PRIVATE AREA
// ========================
Route::middleware(['auth', 'role:influencer'])
    ->prefix('influencer')
    ->group(function () {

        Route::get('/dashboard', [InfluencerDashboardController::class, 'index'])
            ->name('influencer-dashboard');

        Route::get('/profile', [InfluencerProfileController::class, 'showPrivate'])
            ->name('influencer.profile.private');

        Route::delete('/applications/{application}', [InfluencerDashboardController::class, 'destroyApplication'])
            ->name('influencer.applications.destroy');

        Route::post('/portfolio', [PortfolioController::class, 'store'])
            ->name('influencer.portfolio.store');

        Route::put('/portfolio/{item}', [PortfolioController::class, 'update'])
            ->name('influencer.portfolio.update');

        Route::delete('/portfolio/{item}', [PortfolioController::class, 'destroy'])
            ->name('influencer.portfolio.destroy');
    });

// ========================
// Business PRIVATE AREA
// ========================
Route::middleware(['auth', 'role:brand'])
    ->prefix('business')
    ->group(function () {

        Route::get('/dashboard', [BusinessDashboardController::class, 'index'])
            ->name('business-dashboard');

        Route::get('/profile', [BusinessProfileController::class, 'showPrivate'])
            ->name('business.profile.private');

        Route::patch('/applications/{application}/accept', [BusinessDashboardController::class, 'acceptApplication'])
            ->name('business.applications.accept');

        Route::patch('/applications/{application}/decline', [BusinessDashboardController::class, 'declineApplication'])
            ->name('business.applications.decline');
    });

// ========================
// Logout
// ========================
Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// ========================
// Settings
// ========================
Route::middleware('auth')
    ->prefix('settings')
    ->group(function () {

        Route::get('/billing', fn() => view('settings.billing'))->name('settings.billing');
        Route::get('/profile-settings', fn() => view('settings.profile-settings'))->name('settings.profile-settings');
        Route::get('/contact', fn() => view('settings.contact'))->name('settings.contact');
        Route::get('/memberships', [MembershipController::class, 'index'])
            ->name('settings.memberships');
        Route::get('/tax-information', fn() => view('settings.tax-information'))->name('settings.tax-information');
        Route::get('/my-profile', fn() => view('settings.my-profile'))->name('settings.my-profile');
        Route::get('/get-paid', fn() => view('settings.get-paid'))->name('settings.get-paid');
        Route::get('/connected-services', fn() => view('settings.connected-services'))->name('settings.connected-services');
        Route::get('/password-security', fn() => view('settings.password-security'))->name('settings.password-security');
        Route::get('/identity-verification', fn() => view('settings.identity-verification'))->name('settings.identity-verification');
        Route::get('/notifications', fn() => view('settings.notifications'))->name('settings.notifications');

        Route::get('/memberships/membership-plans', [MembershipController::class, 'plans'])
            ->name('membership-plans');
        Route::get('/memberships/membership-plans/review', [MembershipController::class, 'review'])
            ->name('review.membership-plans');
        Route::post('/memberships/membership-plans/switch', [MembershipController::class, 'switch'])
            ->name('membership.switch');
        Route::get('/settings/contact-info', [ContactInfoController::class, 'edit'])
        ->name('settings.contact');

        Route::put('/settings/contact-info', [ContactInfoController::class, 'update'])
        ->name('settings.contact.update');
    });

// ========================
// Help Center
// ========================
Route::get('/help-center', fn() => view('help-center'))->name('help-center');

// ========================
// Jobs
// ========================
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job:slug}', [JobController::class, 'show'])->name('jobs.show');

Route::middleware(['auth'])->group(function () {

    Route::get('/jobs/{job:slug}/apply', [JobApplicationController::class, 'create'])
        ->name('jobs.apply');

    Route::post('/jobs/{job:slug}/apply', [JobApplicationController::class, 'store'])
        ->name('jobs.apply.store');

    Route::get('/settings/password', [PasswordController::class, 'edit'])
        ->name('settings.password');

    Route::put('/settings/password', [PasswordController::class, 'update'])
        ->name('settings.password.update');
});

// ========================
// Job Creation (business)
// ========================
Route::middleware('auth')->group(function () {

    Route::get('/create-job', [JobController::class, 'create'])->name('create-job');
    Route::post('/create-job', [JobController::class, 'store'])->name('create-job.store');
});

// ========================
// Discover Page
// ========================
Route::get('/discover', [DiscoverController::class, 'index'])
    ->name('discover');

// ========================
// PUBLIC INFLUENCER PROFILE
// ========================
Route::get('/influencer/profile/public/{user}', function (Request $request, User $user) {

    $profile = InfluencerProfile::with(['socialAccounts'])
        ->where('user_id', $user->id)
        ->firstOrFail();

    $viewer         = $request->user();
    $matchScore     = null;
    $matchBreakdown = null;

    if ($viewer && $viewer->role === 'brand') {
        $brand = BrandProfile::where('user_id', $viewer->id)->first();

        if ($brand) {
            $detail         = DnaMatchService::calculateBrandToInfluencerBreakdown($brand, $profile);
            $matchScore     = $detail['total'];
            $matchBreakdown = $detail;
        }
    }

    $portfolioItems = PortfolioItem::where('user_id', $user->id)
        ->latest()
        ->take(6)
        ->get();

    return view(
        'influencer-profile-public',
        compact('user', 'profile', 'matchScore', 'matchBreakdown', 'portfolioItems')
    );
})->name('influencer.profile.public');

// ========================
// PUBLIC BUSINESS PROFILE
// ========================
Route::get('/business/profile/public/{user}', [BusinessProfileController::class, 'showPublic'])
    ->name('business.profile.public');

// ========================
// MESSAGES
// ========================
Route::middleware('auth')->group(function () {

    Route::get('/messages/start/{user}', [MessageController::class, 'start'])
        ->name('messages.start');

    Route::post('/messages/contact/{user}', [MessageController::class, 'start'])
        ->name('messages.contact');

    Route::get('/messages/{conversation?}', [MessageController::class, 'index'])
        ->name('messages');

    Route::post('/messages/{conversation}/send', [MessageController::class, 'send'])
        ->name('messages.send');

    Route::post('/messages/{conversation}', [MessageController::class, 'store'])
        ->name('messages.store');
});

Route::patch(
    '/business/jobs/{job}/complete',
    [BusinessDashboardController::class, 'markComplete']
)->name('business.jobs.complete');

Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/users', [AdminController::class, 'users'])
            ->name('users.index');

        Route::post('/users/{user}/approve', [AdminController::class, 'approveUser'])
            ->name('users.approve');

        Route::post('/users/{user}/reject', [AdminController::class, 'rejectUser'])
            ->name('users.reject');
        
        Route::get('/verifications', [VerificationAdminController::class, 'index'])
            ->name('verifications.index');

        Route::post('/verifications/{verification}/approve', [VerificationAdminController::class, 'approve'])
            ->name('verifications.approve');

        Route::post('/verifications/{verification}/reject', [VerificationAdminController::class, 'reject'])
            ->name('verifications.reject');
    });


Route::middleware('auth')->group(function () {
    Route::get('/account/verification', [VerificationController::class, 'show'])
        ->name('account.verification.show');

    Route::post('/account/verification', [VerificationController::class, 'store'])
        ->name('account.verification.store');

    Route::post('/jobs/{job}/rate', [RatingController::class, 'store'])
        ->name('jobs.rate');

    Route::delete('/jobs/{job}/rate', [RatingController::class, 'destroy'])
        ->name('jobs.rate.destroy');

    // Deliverables
    Route::post('/jobs/{job}/deliverables', [DeliverableController::class, 'store'])
        ->name('deliverables.store');

    Route::post('/deliverables/{deliverable}/approve', [DeliverableController::class, 'approve'])
        ->name('deliverables.approve');

    Route::post('/deliverables/{deliverable}/reject', [DeliverableController::class, 'reject'])
        ->name('deliverables.reject');

    // Escrow
    Route::post('/jobs/{job}/escrow/fund', [EscrowController::class, 'fund'])
        ->name('escrow.fund');

    Route::post('/escrow/{escrow}/release', [EscrowController::class, 'release'])
        ->name('escrow.release');

    Route::post('/escrow/{escrow}/cancel', [EscrowController::class, 'cancel'])
        ->name('escrow.cancel');

    Route::get('/finances', [FinanceController::class, 'index'])
        ->name('finances.index');
});


Route::get('/leaderboard');


Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])
    ->name('leaderboard');

Route::get('/help-center/getting-started', [HelpController::class, 'gettingStarted'])
    ->name('getting-started');

<?php

namespace App\Models;

use App\Models\BrandProfile;
use App\Models\Campaign;
use App\Models\Offer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Escrow;
use App\Models\PortfolioItem;
use App\Models\Rating;
use App\Models\JobApplication;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];


    public function brandProfile(): HasOne
    {
        return $this->hasOne(BrandProfile::class);
    }

    public function influencerProfile(): HasOne
    {
        return $this->hasOne(InfluencerProfile::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user')
            ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function verificationRequests(): HasMany
    {
        return $this->hasMany(VerificationRequest::class);
    }

    public function latestVerification()
    {
        return $this->hasOne(VerificationRequest::class)->latestOfMany();
    }

    public function ratingsGiven(): HasMany
    {
        return $this->hasMany(Rating::class, 'from_user_id');
    }

    public function ratingsReceived(): HasMany
    {
        return $this->hasMany(Rating::class, 'to_user_id');
    }

    public function averageRating(): ?float
    {
        return $this->ratingsReceived()->avg('score');
    }

    public function ratingsCount(): int
    {
        return $this->ratingsReceived()->count();
    }

    public function deliverables()
    {
        return $this->hasMany(\App\Models\Deliverable::class);
    }

    public function brandEscrows()
    {
        return $this->hasMany(Escrow::class, 'brand_id');
    }

    public function influencerEscrows()
    {
        return $this->hasMany(Escrow::class, 'influencer_id');
    }

    public function portfolioItems()
    {
        return $this->hasMany(PortfolioItem::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class, 'user_id');
    }
}

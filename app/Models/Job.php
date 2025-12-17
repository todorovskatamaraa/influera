<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rating;
use App\Models\JobApplication;
use App\Models\Escrow;

class Job extends Model
{
    protected $fillable = [
        'user_id',
        'campaign_name',
        'slug',
        'status',
        'industry_category',
        'campaign_overview',
        'looking_for',
        'budget_min',
        'budget_max',
        'campaign_type',
        'influencers_needed',
        'duration',
        'age_min',
        'age_max',
        'gender',
        'influencer_tier',
        'niches',
        'content_tone',
        'content_amount',
        'platforms',
        'brand_values',
        'brand_tones',
    ];

    protected $casts = [
        'niches'        => 'array',
        'platforms'     => 'array',
        'brand_values'  => 'array',
        'brand_tones'   => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($job) {
        $job->slug = \Str::slug($job->campaign_name) . '-' . uniqid();
    });
}

public function applications()
{
    return $this->hasMany(JobApplication::class);
}

public function appliedByUser($userId)
{
    return $this->applications()->where('user_id', $userId)->exists();
}

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function deliverables()
{
    return $this->hasMany(\App\Models\Deliverable::class);
}

    public function escrows()
    {
        return $this->hasMany(Escrow::class);
    }


}

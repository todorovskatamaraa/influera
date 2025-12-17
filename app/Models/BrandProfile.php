<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrandProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_name',
        'industry',
        'about',
        'website',
        'location',
        'company_logo_path',
        'company_cover_path',
        'social_links',
        'campaign_title',
        'age_range',
        'gender',
        'audience_location',
        'niche',
        'budget_type',
        'budget_fixed',
        'budget_min',
        'budget_max',
        'platforms',
        'campaign_brief',
    ];

    protected $casts = [
        'social_links' => 'array',
        'platforms'    => 'array',
        'brand_values' => 'array',
        'brand_tones'  => 'array',
        'niches'       => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

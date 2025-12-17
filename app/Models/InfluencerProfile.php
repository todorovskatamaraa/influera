<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BrandProfile;
use App\Services\DnaMatchService;

class InfluencerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'location',
        'avatar_path',
        'cover_path',
        'audience_location',
        'audience_age_range',
        'audience_gender',
        'niches',
        'content_types',
        'previous_collaborations',
        'portfolio_url',
        'collaboration_types',
        'availability',
        'content_restrictions',
        'pricing_content_type',
        'price_per_content',
        'payment_method',
        'tax_information',
        'agreed_terms',
        'engagement_rate',
        'avg_reach',
        'avg_impressions',
        'conversion_rate',
        'cost_per_engagement',
        'cost_per_click',
        'video_completion_rate',
        'sentiment_score',
        'discount_code_usage',
    ];

    protected $casts = [
        'niches'                => 'array',
        'content_types'         => 'array',
        'collaboration_types'   => 'array',
        'agreed_terms'          => 'boolean',
        'price_per_content'     => 'decimal:2',
        'engagement_rate'       => 'decimal:2',
        'avg_reach'             => 'integer',
        'avg_impressions'       => 'integer',
        'conversion_rate'       => 'decimal:2',
        'cost_per_engagement'   => 'decimal:2',
        'cost_per_click'        => 'decimal:2',
        'video_completion_rate' => 'decimal:2',
        'sentiment_score'       => 'integer',
        'discount_code_usage'   => 'decimal:2',
        'brand_values' => 'array',
        'brand_tones'  => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function socialAccounts()
    {
        return $this->hasMany(InfluencerSocialAccount::class);
    }

    public function calculateDnaScore(): int
    {
        $brands = BrandProfile::all();

        if ($brands->isEmpty()) {
            return 0;
        }

        $scores = [];

        foreach ($brands as $brand) {
            $scores[] = DnaMatchService::calculateInfluencerToBrandScore($this, $brand);
        }

        if (empty($scores)) {
            return 0;
        }

        return (int) round(array_sum($scores) / count($scores));
    }
}

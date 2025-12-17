<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $company_name
 * @property string $industry
 * @property string $about
 * @property string|null $website
 * @property string $location
 * @property string|null $company_logo_path
 * @property string|null $company_cover_path
 * @property array<array-key, mixed>|null $social_links
 * @property string|null $campaign_title
 * @property string|null $age_range
 * @property string|null $gender
 * @property string|null $audience_location
 * @property string|null $niche
 * @property string|null $budget_type
 * @property int|null $budget_fixed
 * @property int|null $budget_min
 * @property int|null $budget_max
 * @property array<array-key, mixed>|null $platforms
 * @property string|null $campaign_brief
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereAgeRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereAudienceLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereBudgetFixed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereBudgetMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereBudgetMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereBudgetType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereCampaignBrief($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereCampaignTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereCompanyCoverPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereCompanyLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereNiche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile wherePlatforms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereSocialLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandProfile whereWebsite($value)
 */
	class BrandProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $phone
 * @property string $location
 * @property string|null $avatar_path
 * @property string|null $cover_path
 * @property string|null $audience_location
 * @property string|null $audience_age_range
 * @property string|null $audience_gender
 * @property array<array-key, mixed>|null $niches
 * @property array<array-key, mixed>|null $content_types
 * @property string|null $previous_collaborations
 * @property string|null $portfolio_url
 * @property array<array-key, mixed>|null $collaboration_types
 * @property string|null $availability
 * @property string|null $content_restrictions
 * @property string|null $pricing_content_type
 * @property numeric|null $price_per_content
 * @property string|null $payment_method
 * @property string|null $tax_information
 * @property bool $agreed_terms
 * @property numeric|null $engagement_rate
 * @property int|null $avg_reach
 * @property int|null $avg_impressions
 * @property numeric|null $conversion_rate
 * @property numeric|null $cost_per_engagement
 * @property numeric|null $cost_per_click
 * @property numeric|null $video_completion_rate
 * @property int|null $sentiment_score
 * @property numeric|null $discount_code_usage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InfluencerSocialAccount> $socialAccounts
 * @property-read int|null $social_accounts_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereAgreedTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereAudienceAgeRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereAudienceGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereAudienceLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereAvatarPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereAvgImpressions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereAvgReach($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereCollaborationTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereContentRestrictions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereContentTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereConversionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereCostPerClick($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereCostPerEngagement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereCoverPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereDiscountCodeUsage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereEngagementRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereNiches($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile wherePortfolioUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile wherePreviousCollaborations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile wherePricePerContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile wherePricingContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereSentimentScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereTaxInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerProfile whereVideoCompletionRate($value)
 */
	class InfluencerProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $influencer_profile_id
 * @property string $platform
 * @property string $username
 * @property int|null $followers
 * @property string|null $engagement_rate
 * @property int|null $average_reach
 * @property string|null $posting_frequency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\InfluencerProfile $profile
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount whereAverageReach($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount whereEngagementRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount whereFollowers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount whereInfluencerProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount wherePostingFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InfluencerSocialAccount whereUsername($value)
 */
	class InfluencerSocialAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BrandProfile|null $brandProfile
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}


<?php

namespace App\Services;

use App\Models\BrandProfile;
use App\Models\InfluencerProfile;
use App\Models\Job;
use App\Models\User;

class DnaMatchService
{
    protected static function toArray($value): array
    {
        if (is_array($value)) {
            return $value;
        }

        if (is_null($value)) {
            return [];
        }

        if (is_string($value)) {
            $value = trim($value);
            if ($value === '') {
                return [];
            }

            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }

            return array_filter(array_map('trim', preg_split('/[,;]+/', $value)));
        }

        return [];
    }

   
    protected static function parseAgeRange(?string $range): ?array
    {
        if (!$range) {
            return null;
        }

        if (preg_match('/(\d+)\s*[-–]\s*(\d+)/', $range, $m)) {
            return [(int) $m[1], (int) $m[2]];
        }

        return null;
    }

   
    protected static function computeGenderScore($jobGender, $infGender): float
    {
        $normalizeTokens = function ($value): array {
            if (is_null($value)) {
                return [];
            }

            $arr = self::toArray($value);

            return array_values(array_unique(array_map(
                fn($g) => mb_strtolower(trim($g)),
                $arr
            )));
        };

        $allSet = ['male', 'female'];

        $jobStr = mb_strtolower(trim((string) $jobGender));

        if ($jobStr === '') {
            return -1.0;
        }

        if (in_array($jobStr, ['any', 'all', 'all-genders'], true)) {
            $required = $allSet;
        } else {
            $required = $normalizeTokens($jobGender);
            if (empty($required)) {
                return -1.0;
            }
        }

        $infStr = mb_strtolower(trim((string) $infGender));

        if (in_array($infStr, ['any', 'all', 'all-genders'], true)) {
            $offered = $allSet;
        } else {
            $offered = $normalizeTokens($infGender);
        }

        if (empty($offered)) {
            return 0.0;
        }

        $matches = count(array_intersect($required, $offered));

        return $matches > 0
            ? ($matches / count($required)) * 100.0
            : 0.0;
    }

   
    protected static function computeJobInfluencerBreakdown(
        Job $job,
        InfluencerProfile $profile
    ): array {
        $scores      = [];
        $nicheScore  = 0.0;
        $ageScore    = 0.0;
        $genderScore = 0.0;

        /**
         * NICHES MATCH
         */
        $requiredNiches = self::toArray($job->niches ?? []);
        $infNiches      = self::toArray($profile->niches ?? []);

        $requiredNiches = array_map('mb_strtolower', $requiredNiches);
        $infNiches      = array_map('mb_strtolower', $infNiches);

        if (!empty($requiredNiches)) {
            $matches = count(array_intersect($requiredNiches, $infNiches));
            $nicheScore = $matches > 0
                ? ($matches / count($requiredNiches)) * 100.0
                : 0.0;

            $scores[] = $nicheScore;
        }

        /**
         * AUDIENCE AGE MATCH
         */
        
        $ageScore = 0.0;

        $ageMin = $job->age_min ?? null;
        $ageMax = $job->age_max ?? null;

        if ($ageMin !== null && $ageMax !== null && $ageMin < $ageMax) {

            $infRange = self::parseAgeRange($profile->audience_age_range ?? null);

            if ($infRange) {
                [$infMin, $infMax] = $infRange;

                $from = max($ageMin, $infMin);
                $to   = min($ageMax, $infMax);

                if ($to > $from) {
                    $jobSpan    = $ageMax - $ageMin;
                    $overlapLen = $to - $from;

                    if ($jobSpan > 0) {
                        $ageScore = ($overlapLen / $jobSpan) * 100.0;
                    } else {
                        $ageScore = 0.0;
                    }
                } else {
                    $ageScore = 0.0;
                }
            } else {
                $ageScore = 0.0;
            }

            $ageScore = max(0.0, min(100.0, $ageScore));

            $scores[] = $ageScore;
        }


        /**
         * AUDIENCE GENDER MATCH
         */
        $jobGenderRaw = $job->gender ?? null;
        $infGenderRaw = $profile->audience_gender ?? null;

        $genderScore = self::computeGenderScore($jobGenderRaw, $infGenderRaw);

        if ($genderScore >= 0) {
            $scores[] = $genderScore;
        }

        $total = !empty($scores)
            ? array_sum($scores) / count($scores)
            : 0.0;

        return [
            'total'  => (int) round($total),
            'niches' => (int) round($nicheScore),
            'age'    => (int) round($ageScore),
            'gender' => (int) round($genderScore),
        ];
    }

    public static function calculateInfluencerToJobScore(
        User $influencerUser,
        Job $job
    ): int {
        $profile = $influencerUser->influencerProfile;

        if (!$profile instanceof InfluencerProfile) {
            return 0;
        }

        $breakdown = self::computeJobInfluencerBreakdown($job, $profile);

        return $breakdown['total'];
    }

    public static function calculateInfluencerToJobBreakdown(
        User $influencerUser,
        Job $job
    ): array {
        $profile = $influencerUser->influencerProfile;

        if (!$profile instanceof InfluencerProfile) {
            return [
                'total'  => 0,
                'niches' => 0,
                'age'    => 0,
                'gender' => 0,
            ];
        }

        return self::computeJobInfluencerBreakdown($job, $profile);
    }

    protected static function makePseudoJobFromBrand(BrandProfile $brand): Job
    {
        $pseudoJob = new Job();

        $brandNiches = [];

        if (is_array($brand->niches ?? null) && !empty($brand->niches)) {
            $brandNiches = $brand->niches;
        } elseif (!empty($brand->niche)) {
            $brandNiches = [$brand->niche];
        } elseif (!empty($brand->industry)) {
            $brandNiches = [$brand->industry];
        }

        $pseudoJob->niches = $brandNiches;

        $ageRange = self::parseAgeRange($brand->age_range ?? null);
        if ($ageRange) {
            [$min, $max] = $ageRange;
            $pseudoJob->age_min = $min;
            $pseudoJob->age_max = $max;
        } else {
            $pseudoJob->age_min = null;
            $pseudoJob->age_max = null;
        }

        $pseudoJob->gender = $brand->gender ?? 'any';

        return $pseudoJob;
    }

    public static function calculateInfluencerToBrandScore(
        InfluencerProfile $influencer,
        BrandProfile $brand
    ): int {
        $jobs = Job::where('user_id', $brand->user_id)->get();

        if ($jobs->isEmpty()) {
            $pseudoJob = self::makePseudoJobFromBrand($brand);
            $breakdown = self::computeJobInfluencerBreakdown($pseudoJob, $influencer);

            return $breakdown['total'];
        }

        $scores = [];

        foreach ($jobs as $job) {
            $breakdown = self::computeJobInfluencerBreakdown($job, $influencer);
            $scores[]  = $breakdown['total'];
        }

        return (int) round(array_sum($scores) / max(count($scores), 1));
    }

    public static function calculateBrandToInfluencerScore(
        BrandProfile $brand,
        InfluencerProfile $influencer
    ): int {
        return self::calculateInfluencerToBrandScore($influencer, $brand);
    }

    public static function calculateBrandToInfluencerBreakdown(
        BrandProfile $brand,
        InfluencerProfile $influencer
    ): array {
        $jobs = Job::where('user_id', $brand->user_id)->get();

        if ($jobs->isEmpty()) {
            $pseudoJob = self::makePseudoJobFromBrand($brand);
            return self::computeJobInfluencerBreakdown($pseudoJob, $influencer);
        }

        $totals  = [];
        $niches  = [];
        $ages    = [];
        $genders = [];

        foreach ($jobs as $job) {
            $break = self::computeJobInfluencerBreakdown($job, $influencer);

            $totals[]  = $break['total'];
            $niches[]  = $break['niches'];
            $ages[]    = $break['age'];
            $genders[] = $break['gender'];
        }

        $avg = fn(array $arr) => (int) round(array_sum($arr) / max(count($arr), 1));

        return [
            'total'  => $avg($totals),
            'niches' => $avg($niches),
            'age'    => $avg($ages),
            'gender' => $avg($genders),
        ];
    }

    public static function calculateInfluencerGlobalScore(InfluencerProfile $influencer): int
    {
        $brands = BrandProfile::all();

        if ($brands->isEmpty()) {
            return 0;
        }

        $scores = [];

        foreach ($brands as $brand) {
            $scores[] = self::calculateInfluencerToBrandScore($influencer, $brand);
        }

        return (int) round(array_sum($scores) / max(count($scores), 1));
    }
}

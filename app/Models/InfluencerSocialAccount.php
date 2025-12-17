<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerSocialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'influencer_profile_id',
        'platform',
        'username',
        'followers',
        'engagement_rate',
        'average_reach',
        'posting_frequency',
    ];

    public function profile()
    {
        return $this->belongsTo(InfluencerProfile::class, 'influencer_profile_id');
    }

    
}

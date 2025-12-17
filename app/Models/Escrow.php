<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Escrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'brand_id',
        'influencer_id',
        'amount',
        'currency',
        'status',
        'funded_at',
        'released_at',
    ];

    protected $casts = [
        'funded_at'   => 'datetime',
        'released_at' => 'datetime',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function brand()
    {
        return $this->belongsTo(User::class, 'brand_id');
    }

    public function influencer()
    {
        return $this->belongsTo(User::class, 'influencer_id');
    }
}

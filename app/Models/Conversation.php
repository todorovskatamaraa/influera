<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'conversation_participants')
            ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public static function firstOrCreateConversationBetween(User $userA, User $userB): self
    {
        $conversation = static::whereHas('participants', function ($q) use ($userA) {
                $q->where('users.id', $userA->id);
            })
            ->whereHas('participants', function ($q) use ($userB) {
                $q->where('users.id', $userB->id);
            })
            ->first();

        if ($conversation) {
            return $conversation;
        }

        $conversation = static::create();
        $conversation->participants()->attach([$userA->id, $userB->id]);

        return $conversation;
    }

    public function otherParticipant(User $authUser): ?User
    {
        return $this->participants->firstWhere('id', '!=', $authUser->id);
    }
}

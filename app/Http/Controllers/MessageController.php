<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(Request $request, Conversation $conversation = null)
    {
        $user   = $request->user();
        $search = $request->query('search');

        $conversations = Conversation::whereHas('participants', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->when($search, function ($q) use ($search, $user) {
                $q->whereHas('participants', function ($sub) use ($search, $user) {
                    $sub->where('users.id', '!=', $user->id)
                        ->where('users.name', 'like', "%{$search}%");
                });
            })
            ->with(['participants', 'lastMessage'])
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($conv) use ($user) {
                $conv->partner = $conv->participants->firstWhere('id', '!=', $user->id) ?? $user;
                return $conv;
            });

        if ($conversation && $conversation->exists) {
            $activeConversation = $conversations->firstWhere('id', $conversation->id)
                ?? $conversation;
        } else {
            $activeConversation = $conversations->first();
        }

        if (!$activeConversation) {
            return view('messages', [
                'conversations'      => $conversations,
                'activeConversation' => null,
                'messages'           => collect(),
            ]);
        }

        $messages = $activeConversation->messages()
            ->with('user')
            ->orderBy('created_at')
            ->get();

        return view('messages', [
            'conversations'      => $conversations,
            'activeConversation' => $activeConversation,
            'messages'           => $messages,
        ]);
    }

    public function start(Request $request, User $user)
    {
        $authUser = $request->user();

        if ($authUser->id === $user->id) {
            return redirect()->route('messages');
        }

        $conversation = Conversation::firstOrCreateConversationBetween($authUser, $user);

        return redirect()->route('messages', $conversation);
    }

    public function send(Request $request, Conversation $conversation)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $user = $request->user();

        if (! $conversation->participants()->where('users.id', $user->id)->exists()) {
            abort(403);
        }

        $conversation->messages()->create([
            'user_id' => $user->id,
            'body'    => $request->input('body'),
        ]);

        $conversation->touch();

        return redirect()->route('messages', $conversation);
    }
}

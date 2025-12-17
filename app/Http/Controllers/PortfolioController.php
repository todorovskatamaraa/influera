<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'campaign_name'     => 'nullable|string|max:255',
            'platform'          => 'nullable|string|max:255',
            'content_url'       => 'nullable|url|max:2048',
            'description'       => 'nullable|string',
            'brand'             => 'nullable|string|max:255',
            'views'             => 'nullable|integer|min:0',
            'likes'             => 'nullable|integer|min:0',
            'comments'          => 'nullable|integer|min:0',
            'testimonial_name'  => 'nullable|string|max:255',
            'testimonial_quote' => 'nullable|string',
        ]);

        $stats = [
            'brand'             => $data['brand']             ?? null,
            'views'             => $data['views']             ?? null,
            'likes'             => $data['likes']             ?? null,
            'comments'          => $data['comments']          ?? null,
            'testimonial_name'  => $data['testimonial_name']  ?? null,
            'testimonial_quote' => $data['testimonial_quote'] ?? null,
        ];

        PortfolioItem::create([
            'user_id'       => Auth::id(),
            'title'         => $data['title'],
            'campaign_name' => $data['campaign_name'] ?? null,
            'platform'      => $data['platform'] ?? null,
            'media_url'     => $data['content_url'] ?? null,
            'description'   => $data['description'] ?? null,
            'stats'         => $stats,
            'is_featured'   => false,
        ]);

        return back()->with('success', 'Portfolio item saved.');
    }

    public function update(Request $request, PortfolioItem $item)
    {
        abort_if($item->user_id !== Auth::id(), 403);

        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'campaign_name'     => 'nullable|string|max:255',
            'platform'          => 'nullable|string|max:255',
            'content_url'       => 'nullable|url|max:2048',
            'description'       => 'nullable|string',
            'brand'             => 'nullable|string|max:255',
            'views'             => 'nullable|integer|min:0',
            'likes'             => 'nullable|integer|min:0',
            'comments'          => 'nullable|integer|min:0',
            'testimonial_name'  => 'nullable|string|max:255',
            'testimonial_quote' => 'nullable|string',
        ]);

        $stats = [
            'brand'             => $data['brand']             ?? null,
            'views'             => $data['views']             ?? null,
            'likes'             => $data['likes']             ?? null,
            'comments'          => $data['comments']          ?? null,
            'testimonial_name'  => $data['testimonial_name']  ?? null,
            'testimonial_quote' => $data['testimonial_quote'] ?? null,
        ];

        $item->update([
            'title'         => $data['title'],
            'campaign_name' => $data['campaign_name'] ?? null,
            'platform'      => $data['platform'] ?? null,
            'media_url'     => $data['content_url'] ?? null,
            'description'   => $data['description'] ?? null,
            'stats'         => $stats,
        ]);

        return back()->with('success', 'Portfolio item updated.');
    }

    public function destroy(PortfolioItem $item)
    {
        abort_if($item->user_id !== Auth::id(), 403);

        $item->delete();

        return back()->with('success', 'Portfolio item removed.');
    }
}

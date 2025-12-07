<?php

namespace Modules\Episode\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Episode\App\Models\Episode;

class EpisodeController extends Controller
{
    public function show(Episode $episode)
    {
        $episode->load('tvShow');

        $user = auth('user')->user();

        $like = $episode->likes()
            ->where('user_id', $user->id)
            ->first();

        $isLiked = $like && $like->is_like === true;
        $isDisliked = $like && $like->is_like === false;

        return view('episode::frontend.show', compact('episode', 'isLiked', 'isDisliked'));
    }

    public function toggle(Episode $episode, Request $request)
    {
        $user = auth('user')->user();
        $type = $request->get('type');

        if (!in_array($type, ['like', 'dislike'], true)) {
            return response()->json(['message' => 'Invalid type'], 422);
        }

        $existing = $episode->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($existing && (($type === 'like' && $existing->is_like) || ($type === 'dislike' && !$existing->is_like))) {
            $existing->delete();

            return response()->json([
                'liked' => false,
                'disliked' => false
            ]);
        }

        if ($existing) {
            $existing->update([
                'is_like' => $type === 'like'
            ]);
        } else {
            $episode->likes()->create([
                'user_id' => $user->id,
                'is_like' => $type === 'like'
            ]);
        }

        return response()->json([
            'liked' => $type === 'like',
            'disliked' => $type === 'dislike'
        ]);
    }
}

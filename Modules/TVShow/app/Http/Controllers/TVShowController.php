<?php

namespace Modules\TVShow\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\TVShow\App\Models\TVShow;

class TVShowController extends Controller
{
    public function toggle(TvShow $tvShow)
    {
        $user = auth('user')->user();

        $isFollowing = $user->followedShows()
            ->where('tv_show_id', $tvShow->id)
            ->exists();

        if ($isFollowing) {
            $user->followedShows()->detach($tvShow->id);
        } else {
            $user->followedShows()->syncWithoutDetaching([$tvShow->id]);
        }

        return response()->json([
            'following' => !$isFollowing
        ]);
    }

    public function show(TvShow $tvShow)
    {
        $episodes = $tvShow->episodes()
            ->whereNotNull('airing_at')
            ->where('airing_at', '<=', now())
            ->orderBy('airing_at', 'desc')
            ->get();

        $isFollowing = false;

        if (auth('user')->check()) {
            $isFollowing = auth('user')->user()
                ->followedShows()
                ->where('tv_show_id', $tvShow->id)
                ->exists();
        }

        return view('tvshow::frontend.show', compact('tvShow', 'episodes', 'isFollowing'));
    }

}

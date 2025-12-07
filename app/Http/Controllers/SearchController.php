<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Episode\App\Models\Episode;
use Modules\TVShow\App\Models\TvShow;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->get('q', ''));

        $tvShows = collect();
        $episodes = collect();

        if ($query !== '') {
            $searchTerm = mb_strtolower($query);

            $buildSearchQuery = function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(slug) LIKE ?', ["%{$searchTerm}%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchTerm}%"]);
            };

            $tvShows = TvShow::query()
                ->where('is_active', true)
                ->where($buildSearchQuery)
                ->orderBy('title')
                ->limit(10)
                ->get();

            $episodes = Episode::query()
                ->with('tvShow')
                ->whereNotNull('airing_at')
                ->where('airing_at', '<=', now())
                ->where($buildSearchQuery)
                ->orderBy('airing_at', 'desc')
                ->limit(20)
                ->get();
        }

        return view('frontend.search', [
            'query' => $query,
            'tvShows' => $tvShows,
            'episodes' => $episodes,
        ]);
    }
}

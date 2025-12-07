<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Modules\Episode\App\Models\Episode;


class HomeController extends Controller
{
    public function index()
    {
        $latestEpisodes = Episode::with('tvShow')
            ->whereNotNull('airing_at')
            ->where('airing_at', '<=', Carbon::now())
            ->orderBy('airing_at', 'desc')
            ->limit(12)
            ->get();;

        return view('frontend.index', compact('latestEpisodes'));
    }
}

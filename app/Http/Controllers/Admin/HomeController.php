<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $genres_count = Genre::query()->count();
        $movies_count = Movie::query()->count();
        $actors_count = Actor::query()->count();

        $popular_movies = Movie::query()->where('type' , null)
            ->limit(5)
            ->orderByDesc('vote_count')
            ->get();

        $now_playing = Movie::query()->where('type' , 'now_playing')
            ->limit(5)
            ->orderByDesc('vote_count')
            ->get();

        $up_coming = Movie::query()->where('type' , 'upcoming')
            ->limit(5)
            ->orderByDesc('vote_count')
            ->get();

        return view('admin.home', compact('genres_count', 'movies_count',
            'actors_count' , 'popular_movies' , 'now_playing' , 'up_coming'));
    }

}

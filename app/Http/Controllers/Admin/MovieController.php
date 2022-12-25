<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read_movies')->only('index');
        $this->middleware('can:delete_movies')->only('destroy');
    }

    public function index()
    {
        $movies = Movie::with('genres')
            ->whenGenreId(\request()->get('genre_id'))
            ->whenActorId(\request()->get('actor_id'))
            ->whenType(\request()->get('type'))
            ->get();

        $genres = Genre::all();

        return view('admin.movies.index', compact('movies', 'genres'));
    }

    public function show(Movie $movie)
    {
        $movie->load(['genres', 'actors', 'images']);
        return view('admin.movies.show', compact('movie'));
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        session()->flash('error', 'Movie Deleted Successfully');
        return redirect()->route('admin.movies.index');
    }
}

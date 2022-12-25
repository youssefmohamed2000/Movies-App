<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActorResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    use BaseTrait;

    public function index()
    {
        $movies = Movie::whenType(\request()->get('type'))
            ->whenSearch(\request()->get('search'))
            ->with('genres')
            ->paginate(8);
        $data['movies'] = MovieResource::collection($movies)->response()->getData(true);
        return $this->sendResponse($data, 'All Movies Sent');
    }

    public function toggleFavourite($id)
    {
        $movie = Movie::query()->find($id);
        if (!$movie) {
            return $this->sendError('Movie Not Exist');
        }
        auth()->user()->favouriteMovies()->toggle($id);
        return $this->sendResponse(null, 'Movie Toggled Successfully');
    }

    public function images($id)
    {
        $movie = Movie::query()->find($id);
        if (!$movie) {
            return $this->sendError('Movie Not Exist');
        }
        return $this->sendResponse(ImageResource::collection($movie->images), 'All Images Sent');
    }

    public function actors($id)
    {
        $movie = Movie::query()->find($id);
        if (!$movie) {
            return $this->sendError('Movie Not Exist');
        }
        return $this->sendResponse(ActorResource::collection($movie->actors), 'All Actors Sent');
    }

    public function relatedMovies($id)
    {
        $movie = Movie::query()->find($id);
        if (!$movie) {
            return $this->sendError('Movie Not Exist');
        }
        $movies = Movie::query()->whereHas('genres', function ($query) use ($movie) {
            return $query->whereIn('name', $movie->genres()->pluck('name'));
        })
            ->with('genres')
            ->where('id', '!=', $id)
            ->paginate(8);
        $data['movies'] = MovieResource::collection($movies)->response()->getData(true);

        return $this->sendResponse($data, 'Related Movies Sent');
    }

    public function favouriteList()
    {
        $movies = Movie::query()->whereHas('favouriteByUser', function ($query) {
            return $query->where('users.id', auth()->user('sanctum')->id);
        })
            ->with('genres')
            ->get();
        return $this->sendResponse(MovieResource::collection($movies), 'Favourite List Sent');
    }
}

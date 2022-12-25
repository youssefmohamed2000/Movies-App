<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    use BaseTrait;

    public function index()
    {
        $genres = Genre::query()->paginate(8);
        return $this->sendResponse(GenreResource::collection($genres), 'All Genre Sent');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read_genres')->only('index');
        $this->middleware('can:delete_genres')->only('destroy');
    }

    public function index()
    {
        $genres = Genre::with('movies')->get();
        return view('admin.genres.index', compact('genres'));
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        session()->flash('error', 'Genre Deleted Successfully');
        return redirect()->route('admin.genres.index');
    }

}

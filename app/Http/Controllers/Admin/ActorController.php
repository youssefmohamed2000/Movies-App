<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read_actors')->only('index');
        $this->middleware('can:delete_actors')->only('destroy');
    }

    public function index()
    {
        $actors = Actor::all();
        return view('admin.actors.index', compact('actors'));
    }

    public function destroy(actor $actor)
    {
        $actor->delete();

        session()->flash('error', 'Actor Deleted Successfully');
        return redirect()->route('admin.actors.index');
    }
}

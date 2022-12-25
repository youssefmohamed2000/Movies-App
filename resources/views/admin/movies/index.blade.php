@extends('layouts.admin.index')

@section('content')

    <div>
        <h2>Movies</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item">Movies</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                    </div>
                </div>
                @include('admin.partials.session')

                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.movies.index') }}" method="get">
                            <div class="form-group">
                                <select class="form-control col-md-5" id="genre" name="genre_id">
                                    <option value="">All Genre</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}"
                                            {{ request()->get('genre_id') == $genre->id ? 'selected' : '' }}>
                                            {{ $genre->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select class="form-control col-md-5" id="type" name="type">
                                    <option value="">All Movies</option>
                                    <option
                                        value="upcoming" {{ request()->get('type') == 'upcoming' ? 'selected' : '' }}>
                                        Upcoming
                                    </option>
                                    <option
                                        value="now_playing" {{ request()->get('type') == 'now_playing' ? 'selected' : '' }}>
                                        Now Playing
                                    </option>
                                </select>
                            </div>
                            <button class="form-control btn btn-primary ">Filter</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="sampleTable">
                                        <thead>
                                        <tr>
                                            <th width="10%">Poster</th>
                                            <th width="15%">Title</th>
                                            <th>Genres</th>
                                            <th width="10%">Vote</th>
                                            <th>Vote Count</th>
                                            <th>Favourite by</th>
                                            <th>Release Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($movies as $movie)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.movies.show' , $movie) }}">
                                                        <img src="{{ $movie->poster_path }}" width="80" height="100">
                                                    </a>
                                                </td>
                                                <td>{{ $movie->title }}</td>
                                                <td>
                                                    @foreach($movie->genres as $genre)
                                                        <h6>
                                                            <span class="badge badge-primary">{{$genre->name}}</span>
                                                        </h6>
                                                    @endforeach
                                                </td>
                                                <td><i class="fa fa-star text-warning"></i> {{  $movie->vote }}</td>
                                                <td>{{  $movie->vote_count }}</td>
                                                <td>{{  $movie->favouriteByUser->count() }}</td>
                                                <td>{{  $movie->release_date }}</td>
                                                <td>
                                                    @can('read_movies')
                                                        <a href="{{ route('admin.movies.show', $movie) }}"
                                                           class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>show</a>
                                                    @endcan
                                                    @can('delete_movies')
                                                        <form action="{{ route('admin.movies.destroy', $movie) }}"
                                                              class="my-1 my-xl-0" method="post"
                                                              style="display: inline-block;">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm delete">
                                                                <i class="fa fa-trash"></i>delete
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('dashboard_files/js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#genre').select2();
        $('#type').select2();
    </script>

@endsection

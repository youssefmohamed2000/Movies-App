@extends('layouts.admin.index')

@section('content')

    <div>
        <h2>Home</h2>
    </div>

    <div class="row">

        <div class="col-md-12">

            @include('admin.partials.session')

            <div class="row" id="top-statistics">

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-list"></span> Genres</p>
                                <a href="{{ route('admin.genres.index') }}">Show All</a>
                            </div>

                            <h3 class="mb-0" id="genres-count">{{ $genres_count }}</h3>
                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-film"></span> Movies</p>
                                <a href="{{ route('admin.movies.index') }}">Show All</a>
                            </div>

                            <h3 class="mb-0" id="movies-count">{{ $movies_count }}</h3>
                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-address-book-o"></span> Actors</p>
                                <a href="{{ route('admin.actors.index') }}">Show All</a>
                            </div>

                            <h3 class="mb-0" id="actors-count">{{ $actors_count }}</h3>
                        </div>

                    </div>

                </div>

            </div>&nbsp;

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex my-2">
                                <h4 class="mb-0">Top Popular Movies</h4>
                                <a href="{{ route('admin.movies.index') }}" class="mx-2 mt-1">Show All</a>
                            </div>

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">Title</th>
                                    <th>Vote</th>
                                    <th>Vote Cont</th>
                                    <th>Release Date</th>
                                </tr>

                                @foreach ($popular_movies as $index => $movie)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a>
                                        </td>
                                        <td><i class="fa fa-star text-warning"></i> <span
                                                class="mx-2">{{ $movie->vote }}</span></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_date }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="d-flex my-2">
                                <h4 class="mb-0">Top Now Playing Movies</h4>
                                <a href="{{ route('admin.movies.index', ['type' => 'now_playing']) }}"
                                   class="mx-2 mt-1">Show All</a>
                            </div>

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">Title</th>
                                    <th>Vote</th>
                                    <th>Vote Cont</th>
                                    <th>Release Date</th>
                                </tr>

                                @foreach ($now_playing as $index => $movie)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a>
                                        </td>
                                        <td><i class="fa fa-star text-warning"></i> <span
                                                class="mx-2">{{ $movie->vote }}</span></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_date }}</td>
                                    </tr>
                                @endforeach
                            </table>

                            <hr>

                            <div class="d-flex my-2">
                                <h4 class="mb-0">Top Upcoming Movies</h4>
                                <a href="{{ route('admin.movies.index', ['type' => 'upcoming']) }}" class="mx-2 mt-1">Show
                                    All</a>
                            </div>

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">Title</th>
                                    <th>Vote</th>
                                    <th>Vote Cont</th>
                                    <th>Release Date</th>
                                </tr>

                                @foreach ($up_coming as $index => $movie)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a>
                                        </td>
                                        <td><i class="fa fa-star text-warning"></i> <span
                                                class="mx-2">{{ $movie->vote }}</span></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_date }}</td>
                                    </tr>
                                @endforeach
                            </table>


                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection


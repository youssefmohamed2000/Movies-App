@extends('layouts.admin.index')

@section('content')

    <div>
        <h2>Genres</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item">Genres</li>
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
                        <div class="tile">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="sampleTable">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Movies Count</th>
                                            <th>Related Movies</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($genres as $genre)
                                            <tr>
                                                <td>{{ $genre->name }}</td>
                                                <td>{{ $genre->movies->count() }}</td>
                                                <td>
                                                    <a href="{{ route('admin.movies.index' , ['genre_id' => $genre->id]) }}"
                                                       class="btn btn-primary btn-sm">Show
                                                        Movies</a>
                                                </td>
                                                <td>{{  date('Y-m-d', strtotime($genre->created_at)) }}</td>
                                                <td>
                                                    @can('delete_genres')
                                                        <form action="{{ route('admin.genres.destroy', $genre) }}"
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

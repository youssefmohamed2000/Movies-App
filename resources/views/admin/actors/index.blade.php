@extends('layouts.admin.index')

@section('content')

    <div>
        <h2>Actors</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item">Actors</li>
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
                    {{--<form action="{{ route('admin.actors.index') }}" class="col-md-12" method="get">
                        <div class="form-group">
                            <select class="form-control col-md-3" id="genre" name="genre_id" required>
                                <option value="all">All Genre</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ request()->get('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="form-control btn btn-primary">Filter</button>
                        </div>
                    </form>--}}
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="sampleTable">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Movies Count</th>
                                            <th>Related Movies</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($actors as $actor)
                                            <tr>
                                                <td><img src="{{ $actor->image_path }}" width="80" height="100"></td>
                                                <td>{{ $actor->name }}</td>
                                                <td>{{  $actor->movies->count() }}</td>
                                                <td>
                                                    <a href="{{ route('admin.movies.index' , ['actor_id' => $actor->id]) }}"
                                                       class="btn btn-primary btn-sm">Show
                                                        Movies</a>
                                                </td>
                                                <td>
                                                    @can('delete_actors')
                                                        <form action="{{ route('admin.actors.destroy', $actor) }}"
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
    </script>

@endsection

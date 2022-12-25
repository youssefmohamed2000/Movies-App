@extends('layouts.admin.index')

@section('content')

    <div>
        <h2>Roles</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item">Roles</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        @can('create_roles')
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>Create</a>
                        @endcan
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
                                            <th>Users Count</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->users->count() }}</td>
                                                <td>{{  date('Y-m-d', strtotime($role->created_at)) }}</td>
                                                <td>
                                                    @can('update_roles')
                                                        <a href="{{ route('admin.roles.edit', $role) }}"
                                                           class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>edit</a>
                                                    @endcan

                                                    @can('delete_roles')
                                                        <form action="{{ route('admin.roles.destroy', $role) }}"
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

@extends('layouts.admin.index')

@section('content')
    <div>
        <h2>Edit Role</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('admin.roles.update' , $role) }}">
                    @csrf
                    @method('put')
                    @include('admin.partials.errors')
                    {{--name--}}
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" autofocus class="form-control"
                               value="{{ old('name' , $role->name) }}" required>
                    </div>

                    <h5>Permissions <span class="text-danger">*</span></h5>

                    @php
                        $models = ['roles', 'admins', 'users' , 'genres' , 'movies' , 'settings'];
                    @endphp

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Model</th>
                            <th>Permissions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($models as $model)
                            <tr>
                                <td>{{ucfirst($model)}}</td>
                                <td>
                                    @php
                                        $permissions = ['create', 'read', 'update', 'delete'];
                                    @endphp
                                    @foreach ($permissions as $permission)
                                        <div class="animated-checkbox mx-2" style="display:inline-block;">
                                            <label class="m-0">
                                                <input type="checkbox" value="{{ $permission . '_' . $model }}"
                                                       name="permissions[]" class="role"
                                                    {{$role->hasPermissionTo($permission . '_' . $model) ? 'checked' : ''}}>
                                                <span class="label-text">{{ucfirst($permission)}}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table><!-- end of table -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Update
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

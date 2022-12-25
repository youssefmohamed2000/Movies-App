@extends('layouts.admin.index')

@section('content')
    <div>
        <h2>Edit Admin</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">Admins</a></li>
        <li class="breadcrumb-item">Edit</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('admin.admins.update' , $admin) }}">
                    @csrf
                    @method('put')
                    @include('admin.partials.errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" autofocus class="form-control"
                               value="{{ old('name' , $admin->name) }}"
                               required>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email' , $admin->email) }}"
                               required>
                    </div>

                    {{--role_id--}}
                    <div class="form-group">
                        <label>Role <span class="text-danger">*</span></label>
                        <select name="role_id[]" class="form-control" multiple required>
                            <option value="">Choose Role</option>
                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }}" {{ $role->id == old('role_id') ? 'selected' : '' }}
                                    {{ $admin->hasRole($role->name) ? 'selected' : ''  }} >{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

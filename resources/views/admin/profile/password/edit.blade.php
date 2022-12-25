@extends('layouts.admin.index')

@section('content')
    <div>
        <h2>Change Password</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item">Change Password</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('admin.profile.password.update') }}">
                    @csrf
                    @method('put')
                    @include('admin.partials.errors')

                    {{--old password--}}
                    <div class="form-group">
                        <label>Old Password <span class="text-danger">*</span></label>
                        <input type="password" name="old_password" autofocus class="form-control" required>
                    </div>

                    {{--new password--}}
                    <div class="form-group">
                        <label>New Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    {{--password confirmation--}}
                    <div class="form-group">
                        <label>Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

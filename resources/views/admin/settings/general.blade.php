@extends('layouts.admin.index')

@section('content')

    <div>
        <h2>Settings</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
                    @include('admin.partials.session')
                    @include('admin.partials.errors')
                    @csrf

                    {{--logo--}}
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control">
                        @if($settings->logo)
                            <img src="{{ Storage::url('uploads/'.$settings->logo) }}" class="form-control"
                                 style="display: {{ $settings->logo ? 'block' : 'none' }}; width: 100px; height: 50px; margin: 10px 0;">
                        @endif
                    </div>

                    {{--fav_icon--}}
                    <div class="form-group">
                        <label>fav_icon</label>
                        <input type="file" name="fav_icon" class="form-control">
                        @if($settings->fav_icon)
                            <img src="{{ Storage::url('uploads/' . $settings->fav_icon) }}" class="form-control"
                                 style="display: {{ $settings->fav_icon ? 'block' : 'none' }}; width: 50px; margin: 10px 0;">
                        @endif
                    </div>

                    {{--title--}}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title',$settings->title) }}">
                    </div>

                    {{--description--}}
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description"
                                  class="form-control">{{ old('description',$settings->description) }}</textarea>
                    </div>

                    {{--keywords--}}
                    <div class="form-group">
                        <label>Keywords</label>
                        <input type="text" name="keywords" class="form-control"
                               value="{{ old('keywords',$settings->keywords) }}">
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control"
                               value="{{ old('email',$settings->email) }}">
                    </div>

                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i>Update
                        </button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

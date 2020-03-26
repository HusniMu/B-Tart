@extends('layout.frontend.main')


@section('title','Member Settings')


@push('css')
<link href="{{asset('assets/frontend/css/member/styles.css')}}" rel="stylesheet">
<link href="{{asset('assets/frontend/css/member/responsive.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('assets/backend/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('assets/backend/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('assets/backend/css/style.css')}}" rel="stylesheet">
@endpush


@section('content')

<section class="blog-area section">
    <div class="container">

        <div class="row">

            @include('member.sidebar')

            <div class="col-lg-8 col-md-12">
                <div class="single-post info-area ">
                    {{-- UPDATE PROFILE --}}
                    <div class="about-area">
                        <form method="post" action="{{route('member.profile.update')}}" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- nama --}}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your Name" value="{{Auth::user()->name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    {{-- email --}}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{Auth::user()->email}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    {{-- image --}}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="image">Profile Image</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name="image" id="image" value="{{Auth::user()->image}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    {{-- about --}}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="about">About</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..." id="about" name="about">{{Auth::user()->about}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- UPDATE PASSWORD --}}
                    <div class="about-area">
                        <form method="post" action="{{route('member.password.update')}}" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            {{-- nama --}}
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="old_password">Old Password</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter your Old Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password">New Password</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your New Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="confirm_password">Confirm Password</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" name="password_confirmation" id="confirm_password" class="form-control" placeholder="Enter your New Password again">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE PASSWORD</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- info-area -->
            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->

@endsection


@push('js')

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('assets/backend/plugins/node-waves/waves.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('assets/backend/js/admin.js')}}"></script>

    <!-- Demo Js -->
    <script src="{{asset('assets/backend/js/demo.js')}}"></script>
@endpush

@extends('layout.frontend.main')


@section('title',Auth::user()->name." Dashboard")
@section('content')

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>CONTACT US</h2>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->


<!-- Start Contact Us  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                @include('member.sidebar')
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="single-post info-area ">
                    {{-- UPDATE PROFILE --}}
                    <h2>Update Profile</h2>
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
                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <hr>
                    <br>
                    {{-- UPDATE PASSWORD --}}
                    <h2>Update Password</h2>
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
        </div>
    </div>
</div>
<!-- End Cart -->

@endsection


@push('js')

@endpush

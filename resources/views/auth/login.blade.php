@extends('layout.frontend.main')
@section('title','Login')
@push('css')
<link href="{{asset('assets/frontend/css/auth/styles.css')}}" rel="stylesheet">
<link href="{{asset('assets/frontend/css/auth/responsive.css')}}" rel="stylesheet">
<style>
    .banner-img{
        background: url({{URL::asset('storage/images/default-banner.jpg')}}) no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -ms-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        text-align: center;
        background-attachment: fixed;
        padding: 70px 0px;
        position: relative;
    }
</style>
@endpush

@section('content')
<!-- Start All Title Box -->
<div class="banner-img all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Login</h2>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group row mb-5">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                    {{--
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                        --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush

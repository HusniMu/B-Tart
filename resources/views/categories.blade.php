@extends('layout.frontend.main')


@section('title', 'All Category')


@push('css')
<link href="{{asset('assets/frontend/css/category/styles.css')}}" rel="stylesheet">
<link href="{{asset('assets/frontend/css/category/responsive.css')}}" rel="stylesheet">

<style>
    .favorite_posts{
        color:blue;
    }
    </style>
@endpush


@section('content')

<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>All Categories ({{$categories->count()}})</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">
            @if ($categories->count()>0)
            @foreach ($categories as $category)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{URL::asset('storage/category/slider/'.$category->image)}}"
                                    alt="{{$category->title}}"></div>

                            <div class="blog-info">
                                <h4 class="title"><a href="{{route('category.posts',$category->slug)}}"><b>{{$category->name}}</b></a></h4>
                                <ul class="post-footer">
                                    <li  style="width:100%;" title="Total posts {{$category->posts->count()}}">
                                        <a href="javascript:void()0;">
                                        <i class="ion-ios-albums"></i>
                                            {{$category->posts->count()}}
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            @endforeach
            @else
                <div class="col-lg-12 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <div class="blog-info">
                                <h4 class="title">
                                    <strong>
                                        <h3>Sorry, No categories found</h3>
                                    </strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->

@endsection

@push('js')

@endpush

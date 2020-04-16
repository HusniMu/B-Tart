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

<!-- Start All Title Box -->
<div class="banner-img all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Semua Kategori ({{$categories->count()}})</h2>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Categories  -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            @if ($categories->count()>0)
                @foreach ($categories as $category)
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                    <img class="img-fluid" src="{{URL::asset('storage/category/slider/'.$category->image)}}" alt="{{$category->name}}" />
                        <a class="btn hvr-hover" href="{{route('category.posts',$category->slug)}}">{{$category->name}}</a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h3>Tidak ada kategori yang tersedia</h3>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- End Categories -->

@endsection

@push('js')

@endpush

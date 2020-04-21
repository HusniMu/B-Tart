@extends('layout.frontend.main')


@section('title','Welcome')
@section('content')

{{-- Banner --}}
<!-- Start Slider -->
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">
        @foreach ($banners as $banner)
            <li class="text-center">
                <img src="{{URL::asset('storage/banner/'.$banner->image)}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20 "><strong>{!! $banner->header !!}</strong></h1>
                            <p class="m-b-40 ">{{$banner->paragraf}}</p>
                            {{-- <a><a class="btn hvr-hover" href="#">Shop New</a></a> --}}
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->
{{-- end banner --}}

<!-- Start Categories  -->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="title-all text-center">
                    <h1>Kategori yang Tersedia</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @if($categories->count() > 0)
                @foreach ($categories as $category)
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                    <img class="img-fluid" src="{{URL::asset('storage/category/slider/'.$category->image)}}" alt="{{$category->name}}" />
                        <a class="btn hvr-hover" href="{{route('category.posts',$category->slug)}}">{{$category->name}}</a>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-12">
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

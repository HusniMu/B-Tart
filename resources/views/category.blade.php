@extends('layout.frontend.main')


@section('title', $category->name)

@push('css')
<style>
    .banner-img{
        background: url({{URL::asset('storage/category/'.$category->image)}}) no-repeat center center;
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
                <h2>Semua Kategori {{$category->name}} ({{$posts->count()}})</h2>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

{{-- all products by category --}}
<div class="products-box">
    <div class="container">
        <div class="row special-list">
            @if ($posts->count()>0)
                @foreach ($posts as $post)
                <div class="col-lg-3 col-md-6 special-grid">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Sale</p>
                            </div>
                            <img src="{{URL::asset('storage/post/'.$post->image)}}" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="{{route('post.details',$post->slug)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                                <a class="cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4>
                                <a href="{{route('post.details',$post->slug)}}">
                                    {{$post->title}}
                                </a>
                            </h4>
                            <h5> Rp. {{number_format($post->harga, 2, ',', '.')}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-12 col-md-12 special-grid">
                    <h3>Maaf, tidak ada produk pada kategori ini</h3>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush

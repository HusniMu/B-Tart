@extends('layout.frontend.main')


@section('title', $hiasan->name)

@push('css')
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
    .product-card{
        height: 250px;
        object-fit: cover;
        object-position: center;
    }
</style>
@endpush

@section('content')

<!-- Start All Title Box -->
<div class="banner-img all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Semua Hiasan {{$hiasan->name}} ({{$posts->count()}})</h2>
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
                <div class="col-lg-3 col-md-4 col-sm-6 special-grid">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <img src="{{URL::asset('storage/post/'.$post->image)}}" class="img-fluid product-card" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="{{route('post.details',$post->slug)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>

                                    @guest
                                    <li>
                                        <a href="javascript:void()0;" onclick="toastr.info('To add wishlist. You neew to login first!.','Info'),{
                                            closeButton: true,
                                            progressBar: true,
                                        }" data-toggle="tooltip" data-placement="right" title="Add to Wishlist">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="javascript:void()0;" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();" data-toggle="tooltip" data-placement="right" title="{{!Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()==0? 'Remove from wishlist':'Add to wishlist'}}">
                                            <i class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()==0? 'fas':'far'}} fa-heart"></i>
                                        </a>
                                        <form action="{{route('post.favorite',$post->id)}}" id="favorite-form-{{$post->id}}" method="post" style="display:none;">
                                            @csrf
                                        </form>
                                    </li>
                                    @endguest
                                    @guest
                                    <li>
                                        <a href="javascript:void()0;" onclick="toastr.info('To add product. You must login first!.','Info'),
                                        {
                                            closeButton: true,
                                            progressBar: true,
                                        }" data-toggle="tooltip" data-placement="right" title="Add to Cart">
                                            <i class="fa fa-cart-plus"></i>
                                        </a>
                                    </li>
                                    @else
                                    <li>
                                        <form action="{{ url('/cart') }}" method="post" id="cart-form-{{ $post->id }}">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                            <input type="hidden" name="title" value="{{ $post->title }}">
                                            <input type="hidden" name="image" value="{{ $post->image }}">
                                            <input type="hidden" name="harga" value="{{ $post->harga }}">
                                            <input type="hidden" name="body" value="{{ $post->body }}">
                                            <input type="hidden" name="categories[]" value="{{ $post->categories }}">
                                            <input type="hidden" name="tags[]" value="{{ $post->tags }}">
                                            <input type="hidden" name="toppings[]" value="{{ $post->toppings }}">
                                            <input type="hidden" name="hiasans[]" value="{{ $post->hiasans }}">
                                            <input type="hidden" name="levels[]" value="{{ $post->levels }}">
                                            <a href="javascript:void()0;" onclick="document.getElementById('cart-form-{{ $post->id }}').submit()"  data-toggle="tooltip" data-placement="right" title="Add to Cart">
                                                <i class="fa fa-cart-plus"></i>
                                            </a>
                                        </form>
                                    </li>
                                    @endguest
                                </ul>
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
                    <h3>Maaf, tidak ada produk pada hiasan ini</h3>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush

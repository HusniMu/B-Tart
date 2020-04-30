@extends('layout.frontend.main')


@section('title',$post->title)

@push('css')
<style>
    .product-card{
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .favorite_posts{
        color:blue;
    }
</style>
@endpush

@section('content')

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        {{-- detail produk --}}
        <div class="row">

                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img class="d-block w-100 product-card" src="{{URL::asset('storage/post/'.$post->image)}}" alt="First slide"> </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{$post->title}}</h2>
                        <h5>Rp. {{number_format($post->harga, 2, ',', '.')}}</h5>
                        <p class="available-stock"><span> Minimal waktu pemesanan : {{$post->lama}} <strong>hari</strong></span>
                            <p>
                                <h4>Description:</h4>
                                <p>{!!$post->body!!}</p>
                                <strong>Note:</strong>
                                @foreach ($post->categories as $category)
                                    <p>{!!$category->body!!}</p>
                                @endforeach
                                <ul>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Kategory</label>
                                                @foreach ($post->categories as $category)
                                                <p>{{$category->name}}</p>
                                                @endforeach
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Rasa: </label>
                                                @if ($post->tags->count()>0)
                                                @foreach ($post->tags as $tag)
                                                <span class="label bg-green">
                                                    <a href="{{route('tag.posts',$tag->slug)}}">
                                                        {{$tag->name}}
                                                    </a>
                                                </span>
                                                @endforeach
                                                @else
                                                <span class="label bg-green">
                                                    tidak ada
                                                </span>
                                                @endif
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Topping: </label>
                                            @if ($post->toppings->count()>0)
                                            @foreach ($post->toppings as $topping)
                                            <span class="label bg-green">
                                                <a href="{{route('topping.posts',$topping->slug)}}">
                                                    {{$topping->name}}
                                                </a>
                                            </span>
                                            @endforeach
                                            @else
                                            <span class="label bg-green">
                                                tidak ada
                                            </span>
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Level: </label>
                                            @if ($post->levels->count()>0)
                                                @foreach ($post->levels as $level)
                                                <span class="label bg-green">
                                                    <a href="{{route('level.posts',$level->slug)}}">
                                                        {{$level->name}}
                                                    </a>
                                                </span>
                                                @endforeach
                                                @else
                                                <span class="label bg-green">
                                                    tidak ada
                                                </span>
                                                @endif
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Hiasan: </label>
                                            @if ($post->hiasans->count()>0)
                                            @foreach ($post->hiasans as $hiasan)
                                            <span class="label bg-green">
                                                <a href="{{route('hiasan.posts',$hiasan->slug)}}">
                                                    {{$hiasan->name}}
                                                </a>
                                            </span>
                                            @endforeach
                                            @else
                                            <span class="label bg-green">
                                                tidak ada
                                            </span>
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label" for="tgl_pengiriman">Tanggal pengiriman</label>
                                            <input class="form-control" type="date" id="tgl_pengiriman" name="tgl_pengiriman" min="{{$tgl_sekarang.'-'.($tgl_tambah+$post->lama)}}">
                                        </div>
                                    </li>
                                </ul>


                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                        <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy</a>

                                        @guest
                                        <a href="javascript:void()0;" class="btn hvr-hover" data-fancybox-close="" onclick="toastr.info('To add product. You must login first!.','Info'),
                                        {
                                            closeButton: true,
                                            progressBar: true,
                                        }">
                                            Add to cart
                                        </a>
                                        @else
                                        <form action="{{ url('/cart') }}" method="post" id="post-cart-form-{{ $post->id }}">
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
                                            <a href="javascript:void()0;" onclick="document.getElementById('post-cart-form-{{ $post->id }}').submit()" class="btn hvr-hover" data-fancybox-close="">
                                                Add to cart
                                            </a>
                                        </form>
                                        @endguest

                                        @guest
                                            <a class="btn hvr-hover" href="javascript:void()0;" onclick="toastr.info('To add wishlist. You neew to login first!.','Info'),{
                                                closeButton: true,
                                                progressBar: true,
                                            }">
                                                <i class="far fa-heart"></i>
                                                {{$post->favorite_to_users->count()}} Add to wishlist
                                            </a>
                                        @else
                                            <a href="javascript:void()0;" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();" class="btn hvr-hover">
                                                <i class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()==0? 'fas':'far'}} fa-heart"></i>
                                                {{!Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()==0? 'Remove from wishlist':'Add to wishlist'}}
                                            </a>
                                            <form action="{{route('post.favorite',$post->id)}}" id="favorite-form-{{$post->id}}" method="post" style="display:none;">
                                                @csrf
                                            </form>
                                        @endguest
                                    </div>
                                </div>
                            </p>
                    </div>
                </div>
        </div>
        {{-- end detail produk --}}
        <hr>
        {{-- featured product --}}
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Featured Products</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                </div>
                <div class="featured-products-box owl-carousel owl-theme">
                    @foreach ($randomPosts as $randomPost)
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{URL::asset('storage/post/'.$randomPost->image)}}" class="img-fluid" alt="{{$randomPost->title}}">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="{{route('post.details',$randomPost->slug)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>

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
                                                <a href="javascript:void()0;" onclick="document.getElementById('favorite-form-{{$randomPost->id}}').submit();" data-toggle="tooltip" data-placement="right" title="{{!Auth::user()->favorite_posts->where('pivot.post_id',$randomPost->id)->count()==0? 'Remove from wishlist':'Add to wishlist'}}">
                                                    <i class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$randomPost->id)->count()==0? 'fas':'far'}} fa-heart"></i>
                                                </a>
                                                <form action="{{route('post.favorite',$randomPost->id)}}" id="favorite-form-{{$randomPost->id}}" method="post" style="display:none;">
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
                                                <form action="{{ url('/cart') }}" method="post" id="cart-form-{{ $randomPost->id }}">
                                                    @csrf

                                                    <input type="hidden" name="id" value="{{ $randomPost->id }}">
                                                    <input type="hidden" name="title" value="{{ $randomPost->title }}">
                                                    <input type="hidden" name="image" value="{{ $randomPost->image }}">
                                                    <input type="hidden" name="harga" value="{{ $randomPost->harga }}">
                                                    <input type="hidden" name="body" value="{{ $randomPost->body }}">
                                                    <input type="hidden" name="categories[]" value="{{ $randomPost->categories }}">
                                                    <input type="hidden" name="tags[]" value="{{ $randomPost->tags }}">
                                                    <input type="hidden" name="toppings[]" value="{{ $randomPost->toppings }}">
                                                    <input type="hidden" name="hiasans[]" value="{{ $randomPost->hiasans }}">
                                                    <input type="hidden" name="levels[]" value="{{ $randomPost->levels }}">
                                                    <a href="javascript:void()0;" onclick="document.getElementById('cart-form-{{ $randomPost->id }}').submit()"  data-toggle="tooltip" data-placement="right" title="Add to Cart">
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
                                        <a href="{{route('post.details',$randomPost->slug)}}">
                                            {{$randomPost->title}}
                                        </a>
                                    </h4>
                                    <h5>Rp. {{number_format($randomPost->harga, 2, ',', '.')}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- featured produk --}}

    </div>
</div>
<!-- End Cart -->

@endsection

@push('js')

@endpush

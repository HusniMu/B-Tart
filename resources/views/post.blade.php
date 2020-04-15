@extends('layout.frontend.main')


@section('title',$post->title)
@section('content')

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"> <img class="d-block w-100" src="{{URL::asset('storage/post/'.$post->image)}}" alt="First slide"> </div>
                        <div class="carousel-item"> <img class="d-block w-100" src="images/big-img-02.jpg" alt="Second slide"> </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                    <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                            <img class="d-block w-100 img-fluid" src="images/smp-img-01.jpg" alt="" />
                        </li>
                        <li data-target="#carousel-example-1" data-slide-to="1">
                            <img class="d-block w-100 img-fluid" src="images/smp-img-02.jpg" alt="" />
                        </li>
                        <li data-target="#carousel-example-1" data-slide-to="2">
                            <img class="d-block w-100 img-fluid" src="images/smp-img-03.jpg" alt="" />
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>{{$post->title}}</h2>
                    <h5>Rp. {{number_format($post->harga, 2, ',', '.')}}</h5>
                    <p class="available-stock"><span> Waktu pembuatan --:--:--</span>
                        <p>
                            <h4>Description:</h4>
                            <p>{!!$post->body!!}</p>
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
                                        <label class="control-label">Quantity</label>
                                        <input class="form-control" value="0" min="0" max="20" type="number">
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Rasa</label>
                                            @foreach ($post->tags as $tag)
                                            <span class="label bg-green">{{$tag->name}}</span>
                                            @endforeach
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Topping</label>
                                            @foreach ($post->toppings as $topping)
                                            <span class="label bg-green">{{$topping->name}}</span>
                                            @endforeach
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Level</label>
                                        @foreach ($post->levels as $level)
                                        <span class="label bg-green">{{$level->name}}</span>
                                        @endforeach
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Hiasan</label>
                                            @foreach ($post->hiasans as $hiasan)
                                            <span class="label bg-green">{{$hiasan->name}}</span>
                                            @endforeach
                                    </div>
                                </li>
                            </ul>

                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a>
                                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a>
                                    <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                                </div>
                            </div>
                </div>
            </div>
        </div>

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
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>{{$randomPost->title}}</h4>
                                    <h5>Rp. {{number_format($randomPost->harga, 2, ',', '.')}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Cart -->

@endsection

@push('js')

@endpush

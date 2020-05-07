@extends('layout.frontend.main')


@section('title', "Make your's own desired cake")

@push('css')
{{-- <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" /> --}}
<link href="{{asset('assets/frontend/js/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<style>
    .product-card{
        height: 100%;
        object-fit: cover;
        object-position: center;
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
                        <div class="carousel-item active"> <img class="d-block w-100 product-card" src="{{URL::asset('storage/images/kue.jpg')}}" alt="First slide"> </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <form action="{{ url('/cart-custom') }}" method="post" id="post-cart-form-{{ $id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="single-product-details">
                        <h2>Custom Cake</h2>
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="title" value="{{ $title }}">
                        <input type="hidden" name="harga" value="{{ $harga }}">
                        <input type="hidden" name="lama" value="{{ $lama }}">
                        {{-- <h5>Rp. {{number_format($post->harga, 2, ',', '.')}}</h5> --}}
                        <p class="available-stock"><span> Minimal waktu pemesanan : {{$lama}} <strong>hari</strong></span>
                            <p>
                                <ul>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label for="category" class="control-label">Select Kategori</label>
                                            <select class="form-control show-tick" id="category" name="category"
                                                data-live-search="true">
                                                <option value="tidak ada" selected disabled>---</option>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label" for="image">Bentuk</label>
                                            <input type="file" name="image" id="image" autofocus value="{{old('image')}}">
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label for="tag" class="control-label">Select Rasa</label>
                                            <select class="form-control show-tick" id="tag" name="tags[]" multiple
                                    data-live-search="true">
                                                <option value="tidak ada" selected disabled>---</option>
                                                @foreach ($tags as $tag)
                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label for="topping" class="control-label">Select Topping</label>
                                            <select class="form-control show-tick" id="topping" name="toppings[]" multiple
                                                data-live-search="true">
                                                <option value="tidak ada" selected disabled>---</option>
                                                @foreach ($toppings as $topping)
                                                <option value="{{$topping->id}}">{{$topping->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label for="level" class="control-label">Select Level</label>
                                            <select class="form-control show-tick" id="level" name="level"
                                                data-live-search="true">
                                                <option value="tidak ada" selected disabled>---</option>
                                                @foreach ($levels as $level)
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label for="hiasan" class="control-label">Select Hiasan</label>
                                            <select class="form-control show-tick" id="hiasan" name="hiasans[]" multiple
                                    data-live-search="true">
                                                <option value="tidak ada" selected disabled>---</option>
                                                @foreach ($hiasans as $hiasan)
                                                <option value="{{$hiasan->id}}">{{$hiasan->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="mx-2 control-label" for="body">Note</label>
                                            <textarea class="form-control" id="body" name="body" placeholder="Note" rows="4">{{old('body')}}</textarea>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label" for="tgl_pengiriman">Tanggal pengiriman</label>
                                            <input class="form-control" type="date" id="tgl_pengiriman" name="tgl_pengiriman" min="{{$tgl_sekarang.'-'.($tgl_tambah+$lama)}}">
                                        </div>
                                    </li>
                                </ul>

                                <div class="price-box-bar">
                                    <div class="cart-and-bay-btn">
                                        {{-- <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a> --}}
                                        @guest
                                        <a href="javascript:void()0;" class="btn hvr-hover" data-fancybox-close="" onclick="toastr.info('To add product. You must login first!.','Info'),
                                        {
                                            closeButton: true,
                                            progressBar: true,
                                        }">
                                            Add to cart
                                        </a>
                                        @else
                                        <a href="javascript:void()0;" onclick="document.getElementById('post-cart-form-{{ $id }}').submit()" class="btn hvr-hover" data-fancybox-close="">
                                        {{-- <a href="" class="btn hvr-hover"> --}}
                                            Add cart
                                        </a>
                                        @endguest
                                    </div>
                                </div>
                            </p>
                    </div>
                </form>
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
{{-- select plugin --}}
<script src="{{asset('assets/frontend/js/bootstrap-select/js/bootstrap-select.js')}}"></script>
{{-- <script src="{{asset('assets/frontend/js/bootstrap-select.js')}}"></script> --}}
@endpush

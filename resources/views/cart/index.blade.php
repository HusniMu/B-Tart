@extends('layout.frontend.main')


@section('title','Shopping Cart')

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
</style>
@endpush

@section('content')

<!-- Start All Title Box -->
<div class="banner-img all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cart</h2>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

{{-- cart --}}
@if(Cart::count()>0)
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produk as $item)
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="#">
                                                <img class="img-fluid" src="{{URL::asset('storage/post/'.$item->model->image)}}" alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="{{route('post.details',$item->model->slug)}}">
                                                {{ $item->model->title }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>Rp. {{ number_format($item->model->harga, 2, ',', '.') }}</p>
                                        </td>
                                        <td class="quantity-box">
                                            <input type="number" size="4" min="0" max="{{ $item->model->stok }}" step="1" class="c-input-text qty text quantity" data-id="{{ $item->rowId }}" value="{{ $item->qty }}">
                                        </td>
                                        <td class="total-pr">
                                            <p>Rp. {{ number_format(($item->model->harga*$item->qty), 2, ',', '.') }}</p>
                                        </td>
                                        <td class="remove-pr">
                                            <form action="/cart/saveForLater/{{ $item->rowId }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-bookmark"></i>
                                                </button>
                                            </form>

                                            <form action="/cart/{{ $item->rowId }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach(Cart::instance('cusPro')->content() as $item)
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="#">
                                                <img class="img-fluid" src="{{URL::asset('storage/custom/'.$item->model->image)}}" alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="{{route('post.details',$item->model->slug)}}">
                                                {{ $item->model->title }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>Rp. {{ number_format($item->model->harga, 2, ',', '.') }}</p>
                                        </td>
                                        <td class="quantity-box">
                                            <input type="number" size="4" min="0" max="{{ $item->model->stok }}" step="1" class="c-input-text qty text quantity" data-id="{{ $item->rowId }}" value="{{ $item->qty }}">
                                        </td>
                                        <td class="total-pr">
                                            <p>Rp. {{ number_format(($item->model->harga*$item->qty), 2, ',', '.') }}</p>
                                        </td>
                                        <td class="remove-pr">
                                            <form action="/cart-custom/{{ $item->rowId }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold">
                                @php
                                    $subProduk = (float)Cart::instance('produk')->subtotal();
                                    $subCus = (float)Cart::instance('cusPro')->subtotal();
                                    $subTotal = ($subProduk+$subCus)*1000;
                                @endphp
                                <input type="hidden" name="subTotal" value="{{ $subTotal }}">
                                Rp. {{ number_format($subTotal, 2, ',', '.') }}
                            </div>
                        </div>
                        <div class="d-flex">
                            <h4>Tax</h4>
                            <div class="ml-auto font-weight-bold">
                                @php
                                    $taxProduk = (float)Cart::instance('produk')->tax();
                                    $taxCus = (float)Cart::instance('cusPro')->tax();
                                    $subTotalTax = ($taxProduk+$taxCus)*1000;
                                @endphp
                                <input type="hidden" name="subTotalTax" value="{{ $subTotalTax }}">
                                Rp. {{ number_format($subTotalTax, 2, ',', '.') }}
                            </div>
                        </div>
                        <div class="d-flex">
                            <h4>Shipping Cost</h4>
                            <div class="ml-auto font-weight-bold"> Free </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5">
                                @php
                                    $total = ($subTotal+$subTotalTax);
                                @endphp
                                <input type="hidden" name="total" value="{{ $total }}">
                                Rp. {{ number_format($total, 2, ',', '.') }}
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-6 d-flex shopping-box"><a href="/" class="ml-auto btn hvr-hover">Continue Shopping</a> </div>
                <div class="col-6 d-flex shopping-box"><a href="{{ route('checkout.index') }}" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->
@else
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>no products in cart</h1>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- save for later --}}
<div class="banner-img all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Item Saved for later</h2>
            </div>
        </div>
    </div>
</div>
@if(Cart::instance('saveForLater')->count()>0)
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Cart::instance('saveForLater')->content() as $item)
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="#">
                                                <img class="img-fluid" src="{{URL::asset('storage/post/'.$item->model->image)}}" alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="{{route('post.details',$item->model->slug)}}">
                                                {{ $item->model->title }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>Rp. {{ number_format($item->model->harga, 2, ',', '.') }}</p>
                                        </td>
                                        <td class="quantity-box">
                                            <input type="number" size="4" value="1" min="0" step="1" class="c-input-text qty text">
                                        </td>
                                        <td class="total-pr">
                                            <p>$ 80.0</p>
                                        </td>
                                        <td class="remove-pr">
                                            <form action="/saveForLater/moveToCart/{{ $item->rowId }}" method="POST">
                                            @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-cart-plus">
                                                    </i>
                                                </button>
                                            </form>
                                            <form action="/saveForLater/{{ $item->rowId }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
@else
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>no products for saved later</h1>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection

@push('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element){
                element.addEventListener('change', function(){
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`,{
                        quantity: this.value
                    })
                    .then(function(response){
                        window.location.href = '{{ url("/cart") }}'
                    })
                    .catch(function(error){
                        window.location.href = '{{ url("/cart") }}'
                    });
                })
            })
        })();
    </script>
@endpush

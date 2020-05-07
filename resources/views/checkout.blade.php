@extends('layout.frontend.main')


@section('title','Checkout')

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
    <div class="all-title-box banner-img">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <form action="">
                <div class="row">
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="checkout-address">
                            <div class="title-left">
                                <h3>Billing address</h3>
                            </div>
                            <div class="mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" placeholder="" name="name" required>
                                <div class="invalid-feedback"> Nama Lengkap harus diisi. </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="" name="email">
                                <div class="invalid-feedback"> Email harus diisi. </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="alamat" placeholder="" name="alamat">
                                <div class="invalid-feedback"> Alamat Lengkap harus diisi. </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="zip">Kode Pos</label>
                                        <input type="text" class="form-control" id="zip" placeholder="" required>
                                        <div class="invalid-feedback"> Kode Pos harus diisi. </div>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label for="no_telp">No HP</label>
                                        <input type="number" class="form-control" id="no_telp" placeholder="" name="no_telp">
                                        <div class="invalid-feedback"> No HP harus diisi. </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="odr-box">
                                    <div class="title-left">
                                        <h3>Shopping cart</h3>
                                    </div>
                                    <div class="rounded p-2 bg-light">
                                        @foreach($produk as $item)
                                            <div class="media mb-2 border-bottom">
                                                <div class="media-body"> <a href="{{route('post.details',$item->model->slug)}}"> {{ $item->model->title }}</a>
                                                    <div class="small text-muted">Price: Rp. {{ number_format($item->model->harga, 2, ',', '.') }} <span class="mx-2">|</span> Qty: {{ $item->qty }} <span class="mx-2">|</span> Subtotal: Rp. {{ number_format(($item->model->harga*$item->qty), 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach(Cart::instance('cusPro')->content() as $item)
                                            <div class="media mb-2 border-bottom">
                                                <div class="media-body"> <a href="{{route('post.details',$item->model->slug)}}"> {{ $item->model->title }}</a>
                                                    <div class="small text-muted">Price: Rp. {{ number_format($item->model->harga, 2, ',', '.') }} <span class="mx-2">|</span> Qty: {{ $item->qty }} <span class="mx-2">|</span> Subtotal: Rp. {{ number_format(($item->model->harga*$item->qty), 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="order-box">
                                    <div class="title-left">
                                        <h3>Your order</h3>
                                    </div>
                                    <div class="d-flex">
                                        <div class="font-weight-bold">Product</div>
                                        <div class="ml-auto font-weight-bold">Total</div>
                                    </div>
                                    <hr class="my-1">
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
                                    <hr> </div>
                            </div>
                            <div class="col-12 d-flex shopping-box"> <a href="checkout.html" class="ml-auto btn hvr-hover">Place Order</a> </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- End Cart -->

@endsection

@push('js')

@endpush

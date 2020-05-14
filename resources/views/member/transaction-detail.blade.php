@extends('layout.frontend.main')


@section('title',Auth::user()->name." Dashboard")
@section('content')

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Detail Transaksi</h2>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->


<!-- Start Contact Us  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                @include('member.sidebar')
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>Detail Transaksi</h2>
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $transaction->id }}</td>
                        </tr>
                        <tr>
                            <th>Pembeli</th>
                            <td>
                                @if(isset($transaction->user))
                                    {{$transaction->user->name}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Penerima</th>
                            <td>{{ $transaction->nama }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $transaction->email }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Lengkap</th>
                            <td>{{ $transaction->alamat_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Kode Pos</th>
                            <td>{{ $transaction->zip }}</td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td>{{ $transaction->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>{{ $transaction->transaction_total }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $transaction->transaction_status }}</td>
                        </tr>
                        <tr>
                            <th>Pembelian</th>
                            <td>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            order id
                                        </th>
                                        <th>
                                            tanggal pengiriman
                                        </th>
                                        <th>
                                            jumlah
                                        </th>
                                        <th>
                                            status
                                        </th>
                                    </tr>
                                    {{-- @foreach($order_id as $id) --}}
                                        @foreach($transaction->details as $detail)
                                        <tr>
                                            <td>
                                                {{ $order_id }}
                                            </td>
                                            <td>
                                                {{ $detail->tgl_pengiriman }}
                                            </td>
                                            <td>
                                                {{ $jumlah }}
                                            </td>
                                            <td>
                                                {{ $detail->pengiriman }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    {{-- @endforeach --}}
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->

@endsection


@push('js')

@endpush

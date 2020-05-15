@extends('layout.frontend.main')


@section('title',Auth::user()->name." Dashboard")
@section('content')

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{Auth::user()->name}} Dashboard </h2>
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
                    <h2>Transaksi</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id Transaksi</th>
                                <th>status</th>
                                <th>at</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($transactions->count()>0)
                                @foreach ($transactions as $key=>$transaction)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            {{ $transaction->id }}
                                        </td>
                                        <td>
                                            {{ $transaction->transaction_status }}
                                        </td>
                                        <td>{{$transaction->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('member.transaction-detail',$transaction->id)}}"
                                                class="btn btn-info waves-effect">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <h3>Tidaka ada transaksi</h3>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
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

@extends('layout.backend.main')


@section('title','Detail Transaksi '.$transaction->user->name)


@push('css')
@endpush


@section('content')
<div class="container-fluid">
    <a href="{{route('admin.transaction.index')}}" class="btn btn-danger waves-effect">Back</a>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-responsive table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $transaction->id }}</td>
                </tr>
                <tr>
                    <th>Pembeli</th>
                    <td>{{ $transaction->user->name }}</td>
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
                                    id
                                </th>
                                <th>
                                    order id
                                </th>
                                <th>
                                    tanggal pengiriman
                                </th>
                            </tr>
                            @foreach($transaction->details as $detail)
                            <tr>
                                <td>
                                    {{ $detail->id }}
                                </td>
                                <td>
                                    @if(isset($detail->post->title))
                                        {{ $detail->post->title }}
                                    @else
                                        {{ $detail->custom->title }}
                                    @endif
                                </td>
                                <td>
                                    {{ $detail->tgl_pengiriman }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endpush

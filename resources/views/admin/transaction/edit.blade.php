@extends('layout.backend.main')


@section('title','Edit - Post')


@push('css')
{{-- select plugin --}}
<link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush


@section('content')
<div class="container-fluid">
    <form action="{{route('admin.transaction.update',$transaction->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT Status Transaction
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <label for="transaction_status">Status</label>
                            <select name="transaction_status" id="transaction_status" required class="form-control">
                                <option value="{{ $transaction->transaction_status }}">
                                    Jangan Ubah ({{ $transaction->transaction_status }})
                                </option>
                                <option value="IN_CART">In Cart</option>
                                <option value="PENDING">Pending</option>
                                <option value="SUCCESS">Success</option>
                                <option value="CANCEL">Cancel</option>
                                <option value="FAILED">Failed</option>
                            </select>
                        </div>
                        <a href="{{route('admin.transaction.index')}}"
                            class="btn btn-danger m-t-15 waves-effect btn-lg">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect btn-lg"
                            autofocus>Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


@push('js')
{{-- select plugin --}}
<script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
@endpush

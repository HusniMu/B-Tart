@extends('layout.backend.main')


@section('title','Create - Topping')


@push('css')

@endpush


@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADD NEW TOPPING
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.topping.store')}}" method="post">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}"
                                    autofocus autocomplete="off">
                                <label class="form-label" for="name">Topping Name</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" id="harga" name="harga" class="form-control" value="{{old('harga')}}"
                                    autofocus autocomplete="off">
                                <label class="form-label" for="harga">Harga</label>
                            </div>
                        </div>

                        <a href="{{route('admin.topping.index')}}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" autofocus>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')

@endpush

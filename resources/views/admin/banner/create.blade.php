@extends('layout.backend.main')


@section('title','Create - Banner')


@push('css')

@endpush


@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADD NEW BANNER
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.banner.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-line">
                            <textarea rows="3" class="form-control no-resize" placeholder="Banner Header ..." name="header">{{old('header')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="4" class="form-control no-resize" placeholder="Banner Paragraf ..." name="paragraf">{{old('paragraf')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" id="image" autofocus>
                        </div>

                        <a href="{{route('admin.banner.index')}}" class="btn btn-danger m-t-15 waves-effect">Back</a>
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

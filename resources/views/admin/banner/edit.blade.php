@extends('layout.backend.main')


@section('title','Edit - Banner')


@push('css')

@endpush


@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        EDIT BANNER - {{$banner->name}}
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.banner.update',$banner->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="form-line">
                            <textarea rows="3" class="form-control no-resize" placeholder="Banner Header ..." name="header">{{$banner->header}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                            <textarea rows="4" class="form-control no-resize" placeholder="Banner Paragraf ..." name="paragraf">{{$banner->paragraf}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" id="image" value="{{$banner->image}}" autofocus>
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

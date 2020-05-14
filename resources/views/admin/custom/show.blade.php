@extends('layout.backend.main')


@section('title',$custom->title)


@push('css')
@endpush


@section('content')
<div class="container-fluid">
    <a href="{{route('admin.custom.index')}}" class="btn btn-danger waves-effect">Back</a>
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$custom->title}}
                        {{-- <small>{{$custom->created_at->toFormattedDateString()}}</small> --}}
                    </h2>
                </div>
                <div class="body" style="width:100%;">
                    {!!$custom->body!!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Categories
                    </h2>
                </div>
                <div class="body">
                    @foreach ($custom->categories as $category)
                    <span class="label bg-cyan">{{$category->name}}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-green">
                    <h2>
                        Tags
                    </h2>
                </div>
                <div class="body">
                    @foreach ($custom->tags as $tag)
                    <span class="label bg-green">{{$tag->name}}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-amber">
                    <h2>
                        Featured Image
                    </h2>
                </div>
                <div class="body">
                    {{-- <img class="img-responsive thumbnail" src="{{Storage::disk('public')->url('custom/'.$custom->image)}}"
                    alt="{{$custom->image}}"> --}}
                    <img class="img-responsive thumbnail" src="{{URL::asset('storage/custom/'.$custom->image)}}"
                        alt="{{$custom->image}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endpush

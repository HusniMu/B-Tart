@extends('layout.frontend.main')


@section('title',Auth::user()->name." Wishlist")
@section('content')

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Wishlist</h2>
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
                    <h2>Wishlist</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>at</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($favorites->count()>0)
                                @foreach ($favorites as $key=>$favorite)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <a href="{{route('post.details',$favorite->slug)}}">
                                                {{$favorite->title}}
                                            </a>
                                        </td>
                                        <td>{{$favorite->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="javascript:void()0;" onclick="document.getElementById('favorite-form-{{$favorite->id}}').submit();" class="btn hvr-hover">
                                                <i class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$favorite->id)->count()==0? 'fas':'far'}} fa-heart"></i>
                                            </a>
                                            <form action="{{route('post.favorite',$favorite->id)}}" id="favorite-form-{{$favorite->id}}" method="post" style="display:none;">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="4">
                                    <h3>tidak ada produk dalam wishlist</h3>
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

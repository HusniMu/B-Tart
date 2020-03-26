@extends('layout.frontend.main')


@section('title','Member Dashboard')


@push('css')
<link href="{{asset('assets/frontend/css/member/styles.css')}}" rel="stylesheet">
<link href="{{asset('assets/frontend/css/member/responsive.css')}}" rel="stylesheet">
@endpush


@section('content')

<section class="blog-area section">
    <div class="container">

        <div class="row">

            @include('member.sidebar')

            <div class="col-lg-8 col-md-12">
                <div class="single-post info-area ">

                    <div class="about-area">
                        <h4 class="title"><b>MEMBER COMMENTS HISTORY</b></h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        comment
                                    </th>
                                    <th>
                                        post
                                    </th>
                                    <th>
                                        at
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $key=>$comment)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$comment->comment}}</td>
                                        <td>
                                            <a href="{{route('post.details',$comment->post->slug)}}">
                                                {{$comment->post->title}}
                                            </a>
                                        </td>
                                        <td>{{$comment->created_at->diffForHumans()}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="title"><b>MEMBER FAVORITE HISTORY</b></h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>liked post</th>
                                    <th>at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favorites as $key=>$favorite)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <a href="{{route('post.details',$favorite->slug)}}">
                                                {{$favorite->title}}
                                            </a>
                                        </td>
                                        <td>{{$favorite->created_at->diffForHumans()}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div><!-- info-area -->
            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->

@endsection


@push('js')

@endpush

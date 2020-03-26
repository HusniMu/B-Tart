@extends('layout.backend.main')


@section('title','Edit - Post')


@push('css')
{{-- select plugin --}}
<link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush


@section('content')
<div class="container-fluid">
    <form action="{{route('admin.post.update',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT POST
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="title" name="title" class="form-control" value="{{$post->title}}"
                                    autofocus autocomplete="off">
                                <label class="form-label" for="title">Enter title here</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="image">Featured Image</label>
                            <input type="file" name="image" id="image" autofocus value="{{$post->image}}">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="status" id="publish" class="filled-in" value="1"
                                {{$post->status==true ? 'checked':''}}>
                            <label for="publish">Publish</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CATEGORIES and TAGS
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('categories') ? 'focused error' : ''}}">
                                <label for="category">Select Categories</label>
                                <select class="form-control show-tick" id="category" name="category"
                                    data-live-search="true">
                                    <option value="---" disabled>Nothing selected</option>
                                    @foreach ($categories as $category)
                                    <option @foreach ($post->categories as $postCategory)
                                        {{$postCategory->id == $category->id ? 'selected':''}}
                                        @endforeach
                                        value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('tags') ? 'focused error' : ''}}">
                                <label for="tag">Select Tags</label>
                                <select class="form-control show-tick" id="tag" name="tags[]" multiple
                                    data-live-search="true">
                                    @foreach ($tags as $tag)
                                    <option @foreach ($post->tags as $postTag)
                                        {{$postTag->id == $tag->id ? 'selected':''}}
                                        @endforeach
                                        value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TOPPINGS and LEVEL
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('toppings') ? 'focused error' : ''}}">
                                <label for="category">Select Toppings</label>
                                <select class="form-control show-tick" id="topping" name="toppings[]" multiple
                                    data-live-search="true">
                                    @foreach ($toppings as $topping)
                                    <option @foreach ($post->toppings as $postTopping)
                                        {{$postTopping->id == $topping->id ? 'selected':''}}
                                        @endforeach
                                        value="{{$topping->id}}">{{$topping->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('level') ? 'focused error' : ''}}">
                                <label for="tag">Select Level</label>
                                <select class="form-control show-tick" id="level" name="level"
                                    data-live-search="true">
                                    <option value="---" disabled >Nothing selected</option>
                                    @foreach ($levels as $level)
                                    <option @foreach ($post->levels as $postLevel)
                                        {{$postLevel->id == $level->id ? 'selected':''}}
                                        @endforeach
                                        value="{{$level->id}}">{{$level->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            HIASANS and HARGA
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('hiasans') ? 'focused error' : ''}}">
                                <label for="category">Select Hiasans</label>
                                <select class="form-control show-tick" id="hiasan" name="hiasans[]" multiple
                                    data-live-search="true">
                                    @foreach ($hiasans as $hiasan)
                                    <option @foreach ($post->hiasans as $postHiasan)
                                        {{$postHiasan->id == $hiasan->id ? 'selected':''}}
                                        @endforeach
                                        value="{{$hiasan->id}}">{{$hiasan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" id="harga" name="harga" class="form-control" placeholder="{{$post->harga}}"
                                    autofocus autocomplete="off">
                                <label class="form-label" for="harga">Harga</label>
                            </div>
                        </div>
                        <a href="{{route('admin.post.index')}}"
                            class="btn btn-danger m-t-15 waves-effect btn-lg">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect btn-lg"
                            autofocus>Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            BODY
                        </h2>
                    </div>
                    <div class="body">
                        <textarea id="ckeditor" name="body">
                            {{$post->body}}
                        </textarea>
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
<!-- Ckeditor -->
<script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>

{{-- <script src="{{asset('assets/backend/js/pages/forms/editors.js')}}"></script> --}}
<script>
    $(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
    CKEDITOR.on('dialogDefinition', function (ev) {
        var dialogName = ev.data.name,
            dialogDefinition = ev.data.definition;

        if (dialogName == 'image') {
            var onOk = dialogDefinition.onOk;

            dialogDefinition.onOk = function (e) {
                var width = this.getContentElement('info', 'txtWidth');
                width.setValue('100%');//Set Default Width

                var height = this.getContentElement('info', 'txtHeight');
                height.setValue('auto');//Set Default height

                onOk && onOk.apply(this, e);
            };
        }
        });
});
</script>
@endpush

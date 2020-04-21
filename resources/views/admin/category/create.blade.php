@extends('layout.backend.main')


@section('title','Create - Category')


@push('css')

@endpush


@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ADD NEW CATEGORY
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}"
                                    autofocus autocomplete="off">
                                <label class="form-label" for="name">Category Name</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="file" name="image" id="image" autofocus>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="body">Detail</label>
                            <textarea id="ckeditor" name="body" id="body">
                                {!!old('body')!!}
                            </textarea>
                        </div>

                        <a href="{{route('admin.category.index')}}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" autofocus>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<!-- Ckeditor -->
<script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>

{{-- <script src="{{asset('assets/backend/js/pages/forms/editors.js')}}"></script> --}}
<script>
    $(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 150;
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

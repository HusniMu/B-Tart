@extends('layout.backend.main')


@section('title','Edit Author Authority - Admin')


@push('css')
{{-- select plugin --}}
<link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush


@section('content')
<div class="container-fluid">
    <form action="{{route('admin.member.update',$user->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT AUTHORITY
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('roles') ? 'focused error' : ''}}">
                                <label for="category">Select Role</label>
                                <select class="form-control show-tick" id="category" name="role" data-live-search="true">
                                    @foreach ($roles as $role)
                                    <option {{$user->role_id == $role->id ? 'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{route('admin.member.index')}}"
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

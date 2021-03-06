@extends('layout.backend.main')
@section('title','Transaction Admin')

@push('css')
<link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}"
    rel="stylesheet">
@endpush

@section('content')

<div class="container-fluid">
    <!-- Basic Examples -->
    <!-- #END# Basic Examples -->
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ALL Transactions
                        <span class="badge bg-info">{{$transactions->count()}}</span>
                        {{-- {{ var_dump($transactions) }} --}}
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>post</th>
                                    <th>custom order</th>
                                    <th>user</th>
                                    <th>total</th>
                                    <th>status</th>
                                    {{-- <th>Updated At</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>post</th>
                                    <th>custom order</th>
                                    <th>user</th>
                                    <th>total</th>
                                    <th>status</th>
                                    {{-- <th>Updated At</th> --}}
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>
                                        @if(isset($transaction->post))
                                            @foreach($transaction->post as $post)
                                            {{ $post->id}}
                                            @endforeach
                                        @endif

                                        {{ $transaction->post_id }}
                                    </td>
                                    <td>
                                        @if(isset($transaction->custom))
                                            @foreach($transaction->custom as $custom)
                                            {{ $custom->id}}
                                            @endforeach
                                        @endif
                                        {{ $transaction->custom_order_id }}
                                    </td>
                                    <td>
                                        @if(isset($transaction->user))
                                            {{$transaction->user->name}}
                                        @endif
                                    </td>
                                    <td>{{$transaction->transaction_total}}</td>
                                    <td>{{$transaction->transaction_status}}</td>
                                    <td>
                                        <a href="{{route('admin.transaction.show',$transaction->id)}}"
                                            class="btn btn-info waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{route('admin.transaction.edit',$transaction->id)}}"
                                            class="btn btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger waves-effect" type="button">
                                            <i class="material-icons" onclick="deletePost({{$transaction->id}})">delete</i>
                                        </button>
                                        <form id="delete-form-{{$transaction->id}}"
                                            action="{{route('admin.transaction.destroy',$transaction->id)}}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>

@endsection
@push('js')
<script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

<script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    function deletePost(id){
        const swal = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-5 mr-5 px-3',
            cancelButton: 'btn btn-danger ml-5 mr-5 px-3',
        },
        buttonsStyling: false,
        })

        swal.fire({
        width: '32rem',
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('delete-form-'+id).submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swal.fire(
            'Cancelled',
            'Your data is safe :)',
            'error'
            )
        }
        })
    }
</script>

<script src="https://kit.fontawesome.com/3f8ec24245.js" crossorigin="anonymous"></script>
@endpush

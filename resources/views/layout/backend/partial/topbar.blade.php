<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            {{-- <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#navbar-collapse" aria-expanded="false"></a> --}}
            <a href="javascript:void(0);" class="bars"></a>
            @if (Request::is('admin*'))
            <a class="navbar-brand" href="{{route('admin.dashboard')}}">Better Tart - Admin</a>
            @endif
        </div>
    </div>
</nav>

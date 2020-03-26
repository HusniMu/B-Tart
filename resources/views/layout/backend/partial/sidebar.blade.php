<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{URL::asset('storage/profile/'.Auth::user()->image)}}" width="48" height="48"
                alt="{{Auth::user()->name}}" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}
            </div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{Auth::user()->role_id==1 ? route('admin.settings'):route('author.settings')}}"><i
                                class="material-icons">settings</i>Settings</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            {{-- admin --}}
            <li class="{{Request::is('admin/dashboard') ? 'active' : ''}}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{Request::is('admin/banner*') ? 'active' : ''}}">
                <a href="{{route('admin.banner.index')}}">
                    <i class="material-icons">apps</i>
                    <span>Banner</span>
                </a>
            </li>
            <li class="{{Request::is('admin/tag*') ? 'active' : ''}}">
                <a href="{{route('admin.tag.index')}}">
                    <i class="material-icons">label</i>
                    <span>Tag</span>
                </a>
            </li>
            <li class="{{Request::is('admin/topping*') ? 'active' : ''}}">
                <a href="{{route('admin.topping.index')}}">
                    <i class="material-icons">label</i>
                    <span>Topping</span>
                </a>
            </li>
            <li class="{{Request::is('admin/hiasan*') ? 'active' : ''}}">
                <a href="{{route('admin.hiasan.index')}}">
                    <i class="material-icons">label</i>
                    <span>Hiasan</span>
                </a>
            </li>
            <li class="{{Request::is('admin/level*') ? 'active' : ''}}">
                <a href="{{route('admin.level.index')}}">
                    <i class="material-icons">label</i>
                    <span>Level</span>
                </a>
            </li>
            <li class="{{Request::is('admin/category*') ? 'active' : ''}}">
                <a href="{{route('admin.category.index')}}">
                    <i class="material-icons">apps</i>
                    <span>Category</span>
                </a>
            </li>
            <li class="{{Request::is('admin/post*') ? 'active' : ''}}">
                <a href="{{route('admin.post.index')}}">
                    <i class="material-icons">library_books</i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="{{Request::is('admin/favorite') ? 'active' : ''}}">
                <a href="{{route('admin.favorite.index')}}">
                    <i class="material-icons">favorite</i>
                    <span>Favorites</span>
                </a>
            </li>
            <li class="{{Request::is('admin/member*') ? 'active' : ''}}">
                <a href="{{route('admin.member.index')}}">
                    <i class="material-icons">account_circle</i>
                    <span>Members</span>
                </a>
            </li>
            <li class="{{Request::is('admin/subscriber') ? 'active' : ''}}">
                <a href="{{route('admin.subscriber.index')}}">
                    <i class="material-icons">subscriptions</i>
                    <span>Subscribers</span>
                </a>
            </li>
            <li class="header">System</li>
            <li class="{{Request::is('admin/settings') ? 'active' : ''}}">
                <a href="{{route('admin.settings')}}">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>


<div class="topbar-menu-area">
    <div class="container">
        <div class="topbar-menu right-menu">
            <ul>
                @guest
                <li class="menu-item" ><a title="Login" href="{{route('login')}}">Login</a></li>
                <li class="menu-item" ><a title="Register" href="{{route('register')}}">Register</a></li>
                @endguest
                @auth
                @if (auth()->user()->roles()->first()->level === 'admin')
                <li class="menu-item" ><a title="Profile" href="{{route('dashboard')}}">Admin</a></li>
                @endif
                <li class="menu-item" ><a title="Profile" href="#">Profile</a></li>
                <li class="menu-item" ><a title="Logout" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" 
                    style="display: none;">
                    @csrf
                </form>
                @endauth
            </ul>
        </div>
    </div>
</div>
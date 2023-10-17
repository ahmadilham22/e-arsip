<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto pr-3">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown d-flex">
            {{-- <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                style="width: 25px; height:25px" alt="User Image"> --}}
            <a class="nav-link dropdown-toggle mr-5 text-dark text-bold navbar-brand" href="#" role="button"
                data-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu">
                @if (Auth::user()->role == 'admin')
                    <a class="dropdown-item" href="{{ route('dahboard.arsip') }}">Perizinan</a>
                @endif
                <a class="dropdown-item" href="{{ route('arsip.myArsip') }}">Arsipku</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </li>
    </ul>
</nav>

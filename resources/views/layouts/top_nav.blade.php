<nav class="sb-topnav navbar navbar-expand navbar  text-black border-bottom bg-white" >
    @php
        $user = Auth::user();
    @endphp
    <!-- Sidebar Toggle-->
    <button class="btn  btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <div class="mx-auto  fs-4">Dashboard</div>
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @if (Auth::check())
                    {{-- Authentication --}}
                    <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    @include('components.logout')
                @else
                    <a class="dropdown-item" href="login">Login</a>
                @endif


            </ul>
        </li>
    </ul>
</nav>
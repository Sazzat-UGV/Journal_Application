<nav class="navbar navbar-expand-md navbar-light fixed-top bg-white">
    <div class="container-fluid m-2">
        {{-- <img class="ms-2" src="{{ asset('assets/Frontend') }}/brand/logo.jpg" alt="" width="72" height="57" /> --}}
        <strong><a class="ms-1 navbar-brand text-success" href="{{ route('homePage') }}">UGV Journals</a></strong>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <!-- Use justify-content-end to align items to the right -->
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.PublicationCreate') }}">Publish Paper</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.PublicationIndex') }}">My Papers</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('uploads/user') }}/{{ Auth::user()->image }}" alt="Profile Image"
                                class="rounded-circle" width="32" height="32">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.changePasswordPage') }}">Change Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endauth
                @guest
                <li class="nav-item ">
                    <a href="{{ route('home.registrationPage') }}" class="nav-link text-white btn btn-success rounded-3 px-4" style="margin-right:10px;">Register</a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('home.loginPage') }}" class="ml-10 nav-link text-white btn btn-success rounded-3 px-4">Sign in</a>
                </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>

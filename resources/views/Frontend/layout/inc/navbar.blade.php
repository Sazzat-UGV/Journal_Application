<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="{{ route('homePage') }}" class="navbar-brand ml-lg-3">
            <h2 class="m-0 text-uppercase text-primary">UGV Journal</h2>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end px-lg-3" id="navbarCollapse">
            @auth
                <div class="navbar-nav  py-0">
                    <a href="{{ route('homePage') }}" class="nav-item nav-link">Home</a>
                    <a href="{{ route('user.PublicationCreate') }}" class="nav-item nav-link">New Publish </a>
                    @php
                        $paperCount = \App\Models\Paper::where('user_id', Auth::user()->id)->count();
                    @endphp
                    <a href="{{ route('user.PublicationIndex') }}" class="nav-item nav-link">My Publications @if ($paperCount)
                        <span
                                style="border: 1px solid red; background: red; padding: 1px 8px; color: white;  border-radius: 50px; font-size: 16px;">{{ $paperCount }}</span>
                        @endif
                            </a>                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown"><img
                                src="{{ asset('uploads/user') }}/{{ Auth::user()->image }}" alt="Profile Image"
                                class="rounded-circle" width="32" height="32">
                            {{ Auth::user()->name }}</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('user.profile') }}" class="dropdown-item active">My Profile</a>
                            <a href="{{ route('user.changePasswordPage') }}" class="dropdown-item">Change Password</a>
                            <a href="{{ route('user.logout') }}" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
            @endauth
            @guest
                <a
                    href="{{ route('home.registrationPage') }}"class="btn btn-primary py-2 px-4 mr-lg-2 mr-0">Register</a><!-- Added responsive classes -->
                <a href="{{ route('home.loginPage') }}"
                    class="btn btn-primary py-2 px-4">Login</a><!-- Added responsive classes -->
            @endguest
        </div>
    </nav>
</div>

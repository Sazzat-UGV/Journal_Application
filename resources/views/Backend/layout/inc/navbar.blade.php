<div class="header">
    <div class="header-left">
        <a href="{{ route('admin.dashboard') }}" class="logo">
            {{-- <img src="{{ asset('assets/Backend') }}/img/logo.png" alt="Logo">
             --}}
             <h3 class="text-center">UGV Journals</h3>
        </a>
        <a href="{{ route('admin.dashboard') }}" class="logo logo-small">
            {{-- <img src="{{ asset('assets/Backend') }}/img/logo-small.png" alt="Logo" width="30" height="30"> --}}

            <h3 class="text-center">UGV</h3></a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fas fa-align-left"></i>
    </a>
    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>
    <ul class="nav user-menu">

        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img class="rounded-circle" src="{{ asset('uploads/user') }}/{{ Auth::user()->image }}"
                        width="31" alt="User Image"></span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ asset('uploads/user') }}/{{ Auth::user()->image }}" alt="User Image"
                            class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{ Auth::user()->name }}</h6>
                        <p class="text-muted mb-0">{{ Auth::user()->role->role_name }}</p>
                    </div>
                </div>
                <a class="dropdown-item" href="{{ route('admin.profilePage') }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('admin.changepasswordpage') }}">Change Password</a>
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
            </div>
        </li>
    </ul>
</div>

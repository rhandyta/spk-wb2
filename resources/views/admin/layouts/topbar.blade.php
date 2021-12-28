<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">


        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                @if (Auth::guard()->user()->photo == 'default.jpg')
                    <img src="{{ asset('assets/images/siswa/default.jpg') }}" alt="Siswa"
                        class="img-profile rounded-circle" width="150">
                @endif
                @if (strlen(Auth::guard()->user()->photo) == 33)
                    <img src="https://drive.google.com/uc?id={{ Auth::guard()->user()->photo }}" alt="Siswa"
                        class="img-profile rounded-circle" width="150">
                @endif
                @if (Auth::guard()->user()->level === "admin")
                    <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile.svg') }}">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>

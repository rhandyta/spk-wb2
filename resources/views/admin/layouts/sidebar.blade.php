<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SMK WB <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @if (Auth::user()->level == 'admin')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::path() == 'admin' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            MASTER DATA
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li
            class="nav-item {{ (((Request::path() == 'admin/tapel' ? 'active' : Request::path() == 'admin/jurusan') ? 'active' : Request::path() == 'admin/kelas') ? 'active' : Request::path() == 'admin/siswa') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-school"></i>
                <span>Sekolah</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Komponen:</h6>
                    <a class="collapse-item" href="{{ route('siswa.index') }}">Siswa</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Sistem Pendukung Keputusan
        </div>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li
            class="nav-item {{ (((Request::path() == 'admin/kriteria' ? 'active' : Request::path() == 'admin/penilaian') ? 'active' : Request::path() == 'admin/nilai') ? 'active' : Request::path() == 'admin/hasil') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-gavel"></i>
                <span>SPK</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Keperluan:</h6>
                    <a class="collapse-item" href="{{ route('kriteria.index') }}">Kriteria</a>
                    <a class="collapse-item" href="{{ route('penilaian.index') }}">Nilai Crips</a>
                    <a class="collapse-item" href="{{ route('nilai.index') }}">Nilai Bobot Alternatif</a>
                    <a class="collapse-item" href="{{ route('hasil.index') }}">Hasil</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Hasil Pemungutan Suara
        </div>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li
            class="nav-item {{ (Request::path() == 'admin/kandidat' ? 'active' : Request::path() == 'admin/hasil-vote') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-poll"></i>
                <span>Voting</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Keperluan:</h6>
                    <a class="collapse-item" href="{{ route('hasil.kandidat') }}">Kandidat</a>
                    <a class="collapse-item" href="{{ route('hasil.vote') }}">Hasil Pemilihan </a>
                </div>
            </div>
        </li>
    @endif
    @if (Auth::user()->level != 'admin')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::path() == 'siswa/vote' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('vote.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Vote</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#logoutModal" href="#">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

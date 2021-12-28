{{-- header --}}
    @include('admin.layouts.header')
{{-- tutup header --}}

        <!-- Sidebar -->
            @include('admin.layouts.sidebar')
        {{-- End Sidebat --}}

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    @include('admin.layouts.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
                    <div class="container">
                        <div class="session">
                            @include('admin.layouts.partials.alert')
                        </div>
                        @yield('content')
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
                @include('admin.layouts.footer')
            {{-- End Footer --}}
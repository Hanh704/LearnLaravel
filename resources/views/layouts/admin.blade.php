@include('admin.partials.header')
        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="ms-auto d-flex">
                        <div class="input-group me-3">
                            <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            <button class="btn btn-outline-secondary" type="button"><i
                                    class="bi bi-search"></i></button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> Admin
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Hồ sơ</a>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Cài đặt</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>
                                        Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            @yield('content')
        </div>
    </div>
    @yield('scripts')
@include('admin.partials.footer')
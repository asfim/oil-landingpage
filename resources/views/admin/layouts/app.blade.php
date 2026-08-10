<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background: #343a40; color: #fff; }
        .sidebar a { color: #c2c7d0; text-decoration: none; padding: 10px 15px; display: block; border-radius: 4px; margin-bottom: 5px; }
        .sidebar a:hover, .sidebar a.active { background: #007bff; color: #fff; }
        .sidebar .nav-icon { width: 25px; text-align: center; margin-right: 5px; }
        .main-content { padding: 20px; }
        .top-header { background: #fff; padding: 10px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <!-- Desktop Sidebar -->
        @auth
        <div class="sidebar p-3 d-none d-md-block" style="width: 250px; flex-shrink: 0;">
            <h4 class="text-center mb-4 text-white">Admin Panel</h4>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 nav-icon"></i> Dashboard
            </a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-cart nav-icon"></i> Orders
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box nav-icon"></i> Products
            </a>
            <h6 class="mt-4 mb-2 text-uppercase text-muted" style="font-size: 0.8rem; padding-left: 15px;">Landing Page</h6>
            <a href="{{ route('admin.why-choose.index') }}" class="{{ request()->routeIs('admin.why-choose.*') ? 'active' : '' }}">
                <i class="bi bi-star nav-icon"></i> Why Choose Us
            </a>
            <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear nav-icon"></i> Website Settings
            </a>
        </div>

        <!-- Mobile Sidebar (Offcanvas) -->
        <div class="offcanvas offcanvas-start bg-dark text-white p-3 d-md-none" tabindex="-1" id="mobileSidebar" style="width: 260px;">
            <div class="offcanvas-header border-bottom border-secondary mb-3">
                <h5 class="offcanvas-title text-white">Admin Panel</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="sidebar">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 nav-icon"></i> Dashboard
                </a>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-cart nav-icon"></i> Orders
                </a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box nav-icon"></i> Products
                </a>
                <h6 class="mt-4 mb-2 text-uppercase text-muted" style="font-size: 0.8rem; padding-left: 15px;">Landing Page</h6>
                <a href="{{ route('admin.why-choose.index') }}" class="{{ request()->routeIs('admin.why-choose.*') ? 'active' : '' }}">
                    <i class="bi bi-star nav-icon"></i> Why Choose Us
                </a>
                <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear nav-icon"></i> Website Settings
                </a>
            </div>
        </div>
        @endauth

        <!-- Main Content -->
        <div class="flex-grow-1" style="min-width: 0;">
            @auth
            <!-- Header -->
            <div class="top-header">
                <div>
                    <button class="btn btn-light d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <span class="fs-5 fw-semibold ms-2">@yield('title', 'Dashboard')</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> View Site</a>
                    <div class="dropdown">
                        <a href="#" class="text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5 align-middle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('admin.clear-cache') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-arrow-repeat me-2"></i> Clear Cache</button>
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('admin.clear-logs') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-trash me-2"></i> Clear Logs</button>
                                </form>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Page Content -->
            <div class="main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

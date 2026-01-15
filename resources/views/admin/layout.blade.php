<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forest Eco Resort - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-sidebar {
            min-height: 100vh;
            background: linear-gradient(to bottom, #193C26, #0d2a1a);
            color: #F0EAAF;
        }
        .admin-main {
            min-height: 100vh;
        }
        .admin-card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 admin-sidebar p-3">
                <div class="d-flex align-items-center mb-4">
                    <i class="fas fa-tree me-2"></i>
                    <h4 class="text-warning mb-0">Admin Panel</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('admin/dashboard') ? 'bg-warning text-dark' : '' }}" href="/admin/dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('admin/hero') ? 'bg-warning text-dark' : '' }}" href="/admin/hero">
                            <i class="fas fa-star me-2"></i>Hero Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('admin/about-us') ? 'bg-warning text-dark' : '' }}" href="/admin/about-us">
                            <i class="fas fa-info-circle me-2"></i>About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('admin/join-pilots') ? 'bg-warning text-dark' : '' }}" href="/admin/join-pilots">
                            <i class="fas fa-users me-2"></i>Join Pilot
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light {{ request()->is('admin/stay-updated') ? 'bg-warning text-dark' : '' }}" href="/admin/stay-updated">
                            <i class="fas fa-envelope me-2"></i>Stay Updated
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 admin-main p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>@yield('title', 'Admin Dashboard')</h2>
                    <div>
                        <a href="http://localhost:3000" target="_blank" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-home me-1"></i>Visit Site
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm ms-2">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
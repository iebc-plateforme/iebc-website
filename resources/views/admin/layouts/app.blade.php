<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - IEBC Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-color);
            color: white;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar .logo {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .logo h4 {
            margin: 0;
            color: white;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left-color: var(--secondary-color);
        }

        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            background: #f8f9fa;
        }

        .top-navbar {
            background: white;
            padding: 1rem 2rem;
            margin: -2rem -2rem 2rem -2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: white;
            border-bottom: 2px solid var(--secondary-color);
            font-weight: 600;
        }

        .btn-primary {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary:hover {
            background: #2980b9;
            border-color: #2980b9;
        }

        .table {
            background: white;
        }

        .badge {
            padding: 0.5rem 0.75rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.show {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <h4>IEBC Admin</h4>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                <i class="fas fa-briefcase"></i> Services
            </a>
            <a class="nav-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">
                <i class="fas fa-handshake"></i> Partenaires
            </a>
            <a class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}" href="{{ route('admin.teams.index') }}">
                <i class="fas fa-users"></i> Équipe
            </a>
            <a class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                <i class="fas fa-newspaper"></i> Actualités
            </a>
            <a class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}">
                <i class="fas fa-images"></i> Galerie
            </a>
            <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                <i class="fas fa-envelope"></i> Messages
                @php
                    $unreadCount = \App\Models\Contact::where('is_read', false)->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge bg-danger ms-2">{{ $unreadCount }}</span>
                @endif
            </a>
            <hr style="border-color: rgba(255,255,255,0.1);">
            @if(Auth::user()->isSuperAdmin())
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-user-shield"></i> Utilisateurs
                </a>
            @endif
            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                <i class="fas fa-cog"></i> Paramètres
            </a>
            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                <i class="fas fa-user-circle"></i> Mon Profil
            </a>
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-globe"></i> Voir le site
            </a>
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-link d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 d-inline">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                @php
                    $unreadCount = \App\Models\Contact::where('is_read', false)->count();
                @endphp
                @if($unreadCount > 0)
                    <a href="{{ route('admin.contacts.index') }}" class="position-relative text-decoration-none">
                        <i class="fas fa-bell fs-5 text-warning"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $unreadCount }}
                        </span>
                    </a>
                @endif
                <span class="text-muted">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    @if(Auth::user()->isSuperAdmin())
                        <span class="badge bg-danger ms-1">Super Admin</span>
                    @else
                        <span class="badge bg-primary ms-1">Admin</span>
                    @endif
                </span>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    @stack('scripts')
</body>
</html>

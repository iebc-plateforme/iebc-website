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
            overflow-x: hidden;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .logo h4,
        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .nav-section-title,
        .sidebar.collapsed .badge {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            padding: 0.75rem;
            text-align: center;
            justify-content: center;
        }

        .sidebar.collapsed .nav-link i {
            margin: 0;
        }

        .sidebar .logo {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar .logo h4 {
            margin: 0;
            color: white;
            font-size: 1.25rem;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .sidebar-toggle:hover {
            background: rgba(255,255,255,0.1);
        }

        .nav-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255,255,255,0.5);
            padding: 1rem 1.5rem 0.5rem;
            font-weight: 600;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
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
            text-align: center;
        }

        .sidebar .nav-link .badge {
            margin-left: auto;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            background: #f8f9fa;
            transition: margin-left 0.3s;
        }

        .main-content.sidebar-collapsed {
            margin-left: 70px;
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
            <button class="sidebar-toggle d-none d-lg-block" id="sidebarCollapseBtn" title="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <nav class="nav flex-column">
            <!-- Dashboard -->
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <!-- Content Section -->
            <div class="nav-section-title">Contenu</div>
            <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                <i class="fas fa-briefcase"></i>
                <span>Services</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                <i class="fas fa-newspaper"></i>
                <span>Actualités</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}">
                <i class="fas fa-images"></i>
                <span>Galerie</span>
            </a>

            <!-- People Section -->
            <div class="nav-section-title">Personnes</div>
            <a class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}" href="{{ route('admin.teams.index') }}">
                <i class="fas fa-users"></i>
                <span>Équipe</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">
                <i class="fas fa-handshake"></i>
                <span>Partenaires</span>
            </a>
            @if(Auth::user()->isSuperAdmin())
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Utilisateurs</span>
                </a>
            @endif

            <!-- Communication Section -->
            <div class="nav-section-title">Communication</div>
            <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
                @php
                    $unreadCount = \App\Models\Contact::where('is_read', false)->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                @endif
            </a>

            <!-- Settings Section -->
            <div class="nav-section-title">Configuration</div>
            <a class="nav-link {{ request()->routeIs('admin.themes.*') ? 'active' : '' }}" href="{{ route('admin.themes.index') }}">
                <i class="fas fa-palette"></i>
                <span>Thèmes</span>
            </a>
            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                <i class="fas fa-cog"></i>
                <span>Paramètres</span>
            </a>

            <!-- User Section -->
            <div class="nav-section-title">Utilisateur</div>
            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                <i class="fas fa-user-circle"></i>
                <span>Mon Profil</span>
            </a>
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-globe"></i>
                <span>Voir le site</span>
            </a>
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Déconnexion</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
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

        // Sidebar collapse for desktop
        const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        // Load saved collapse state from localStorage
        const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (sidebarCollapsed) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('sidebar-collapsed');
        }

        sidebarCollapseBtn?.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('sidebar-collapsed');

            // Save state to localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
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

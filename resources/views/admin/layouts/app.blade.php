<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Properti Kotabaru')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #3b82f6;
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --border-color: #e2e8f0;
            --danger-color: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: #374151;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            color: var(--dark-color);
        }

        /* Sidebar Navigation */
        .sidebar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            height: 100vh;
            padding: 30px 20px;
            position: fixed;
            width: 280px;
            left: 0;
            top: 0;
            box-shadow: 0 4px 20px rgba(30, 58, 138, 0.15);
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Scrollbar styling untuk sidebar */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .sidebar .brand i {
            font-size: 2rem;
        }

        .sidebar .nav-menu {
            list-style: none;
        }

        .sidebar .nav-menu li {
            margin-bottom: 15px;
        }

        .sidebar .nav-menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar .nav-menu a:hover,
        .sidebar .nav-menu a.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: var(--accent-color);
            transform: translateX(5px);
        }

        .sidebar .nav-menu i {
            font-size: 1.1rem;
            width: 20px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 30px;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            border-radius: 12px;
            padding: 20px 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h1 {
            font-size: 1.8rem;
            margin: 0;
        }

        .top-bar .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-bar .user-info .avatar {
            width: 40px;
            height: 40px;
            background: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        /* Content Area */
        .content {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            border-left: 4px solid;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d1fae5;
            border-left-color: #10b981;
            color: #065f46;
        }

        .alert-danger {
            background-color: #fee2e2;
            border-left-color: #ef4444;
            color: #991b1b;
        }

        /* Tables */
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table thead th {
            background-color: #f3f4f6;
            color: var(--dark-color);
            font-weight: 700;
            padding: 15px;
            text-align: left;
            border: none;
        }

        .table tbody td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }

        /* Forms */
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 20px;
            border: none;
        }

        .card-body {
            padding: 20px;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--secondary-color);
            margin-bottom: 20px;
        }

        .stat-card h5 {
            color: #9ca3af;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding: 20px;
                margin-bottom: 20px;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .top-bar {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-auto p-0">
                <aside class="sidebar">
                    <div class="brand">
                        <i class="fas fa-building"></i>
                        <span>Admin</span>
                    </div>

                    <ul class="nav-menu">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-chart-line"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.properties.index') }}" class="{{ Route::is('admin.properties.*') ? 'active' : '' }}">
                                <i class="fas fa-home"></i>
                                <span>Properties</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="{{ Route::is('admin.categories.*') ? 'active' : '' }}">
                                <i class="fas fa-tags"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.sliders.index') }}" class="{{ Route::is('admin.sliders.*') ? 'active' : '' }}">
                                <i class="fas fa-image"></i>
                                <span>Sliders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.launchings.index') }}" class="{{ Route::is('admin.launchings.*') ? 'active' : '' }}">
                                <i class="fas fa-rocket"></i>
                                <span>Launching</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.facilities.index') }}" class="{{ Route::is('admin.facilities.*') ? 'active' : '' }}">
                                <i class="fas fa-building"></i>
                                <span>Facilities</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.inquiries.index') }}" class="{{ Route::is('admin.inquiries.*') ? 'active' : '' }}">
                                <i class="fas fa-envelope"></i>
                                <span>Inquiries</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.about.show') }}" class="{{ Route::is('admin.about.*') ? 'active' : '' }}">
                                <i class="fas fa-info-circle"></i>
                                <span>Tentang Kami & Visi Misi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="{{ Route::is('admin.users.*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                <span>Admin Users</span>
                            </a>
                        </li>
                        <li style="border-top: 1px solid rgba(255, 255, 255, 0.2); padding-top: 15px; margin-top: 15px;">
                            <a href="{{ route('admin.users.change-password') }}" class="{{ Route::is('admin.users.change-password') ? 'active' : '' }}">
                                <i class="fas fa-key"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="post" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; width: 100%; text-align: left;">
                                    <a style="display: flex; align-items: center; gap: 15px; color: rgba(255, 255, 255, 0.9); text-decoration: none; padding: 12px 15px; border-radius: 8px; transition: all 0.3s ease; font-weight: 500;">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </button>
                            </form>
                        </li>
                    </ul>
                </aside>
            </div>

            {{-- Main Content --}}
            <div class="col p-0">
                <div class="main-content">
                    {{-- Top Bar --}}
                    <div class="top-bar">
                        <h1>@yield('page-title', 'Admin Panel')</h1>
                        <div class="user-menu">
                            <div class="user-info">
                                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                                <div>
                                    <div style="font-weight: 600;">{{ auth()->user()->name }}</div>
                                    <div style="font-size: 0.85rem; color: #9ca3af;">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Alerts --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> <strong>Terjadi Kesalahan!</strong>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Content --}}
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

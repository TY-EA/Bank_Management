
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bankati Pro - Admin Dashboard')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0052CC;
            --primary-dark: #003A99;
            --secondary: #00B4D8;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --dark: #1F2937;
            --light: #F9FAFB;
            --border: #E5E7EB;
            --text: #374151;
        }

        html, body {
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', sans-serif;
            background: var(--light);
            color: var(--text);
        }

        .app-wrapper {
            display: flex;
            height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            padding: 30px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-logo {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .sidebar-subtitle {
            font-size: 12px;
            opacity: 0.7;
            margin-top: 4px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }

        .sidebar-menu-item {
            margin: 0;
        }

        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar-menu-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 24px;
        }

        .sidebar-menu-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-right: 3px solid white;
        }

        .sidebar-menu-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 15px 0;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            opacity: 0.7;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ========== TOP BAR ========== */
        .topbar {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 0 30px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            z-index: 900;
            transition: left 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .topbar.expand {
            left: 0;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-toggle {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: var(--primary);
            display: none;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            color: var(--primary-dark);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text);
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb-separator {
            color: var(--border);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--light);
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid var(--border);
            max-width: 300px;
        }

        .search-bar input {
            background: none;
            border: none;
            outline: none;
            font-size: 14px;
            flex: 1;
            color: var(--text);
        }

        .search-bar input::placeholder {
            color: #9CA3AF;
        }

        .search-bar i {
            color: #9CA3AF;
            font-size: 16px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: var(--text);
            transition: all 0.3s ease;
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-btn:hover {
            background: var(--light);
            color: var(--primary);
        }

        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: var(--danger);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
        }

        .logout-btn {
            padding: 10px 16px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 82, 204, 0.3);
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex: 1;
            margin-left: 280px;
            margin-top: 80px;
            padding: 40px;
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }

        .main-content.expand {
            margin-left: 0;
        }

        .page-header {
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #6B7280;
        }

        /* ========== METRICS GRID ========== */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .metric-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid var(--border);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--metric-color, var(--primary));
            border-radius: 12px 12px 0 0;
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
            border-color: var(--metric-color, var(--primary));
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .metric-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            background: rgba(var(--metric-rgb, 0, 82, 204), 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--metric-color, var(--primary));
        }

        .metric-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1;
        }

        .metric-change {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: var(--success);
        }

        .metric-change.negative {
            color: var(--danger);
        }

        .metric-change i {
            font-size: 12px;
        }

        /* Color variants */
        .metric-card.primary { --metric-color: var(--primary); --metric-rgb: 0, 82, 204; }
        .metric-card.secondary { --metric-color: var(--secondary); --metric-rgb: 0, 180, 216; }
        .metric-card.success { --metric-color: var(--success); --metric-rgb: 16, 185, 129; }
        .metric-card.warning { --metric-color: var(--warning); --metric-rgb: 245, 158, 11; }

        /* ========== TABLES & CONTENT ========== */
        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            margin-bottom: 24px;
        }

        .card-header {
            padding: 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
        }

        .card-body {
            padding: 24px;
        }

        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 82, 204, 0.3);
        }

        .btn-secondary {
            background: var(--secondary);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 180, 216, 0.3);
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-ghost {
            background: var(--light);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-ghost:hover {
            background: white;
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* ========== TABLES ========== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: var(--light);
            border-bottom: 2px solid var(--border);
        }

        table th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        table tbody tr {
            transition: all 0.3s ease;
        }

        table tbody tr:hover {
            background: var(--light);
        }

        .table-actions {
            display: flex;
            gap: 8px;
        }

        /* ========== ALERTS ========== */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .alert-info {
            background: rgba(0, 82, 204, 0.1);
            color: var(--primary);
            border: 1px solid rgba(0, 82, 204, 0.2);
        }

        .alert i {
            font-size: 18px;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1024px) {
            .sidebar {
                width: 250px;
            }

            .topbar {
                left: 250px;
            }

            .main-content {
                margin-left: 250px;
                padding: 30px;
            }

            .page-title {
                font-size: 28px;
            }

            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .sidebar.hidden {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
                padding: 0 20px;
            }

            .topbar.expand {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                margin-top: 80px;
                padding: 20px;
            }

            .main-content.expand {
                margin-left: 0;
            }

            .menu-toggle {
                display: flex;
            }

            .search-bar {
                display: none;
            }

            .page-title {
                font-size: 24px;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .metric-card {
                padding: 20px;
            }

            .page-header {
                margin-bottom: 30px;
            }

            .sidebar-footer {
                display: none;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            table {
                font-size: 12px;
            }

            table th, table td {
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 20px;
            }

            .metric-value {
                font-size: 24px;
            }

            .topbar-right {
                gap: 10px;
            }

            .icon-btn {
                width: 36px;
                height: 36px;
            }

            .logout-btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 12px;
            }

            .card-header {
                padding: 16px;
            }

            .card-body {
                padding: 16px;
            }
        }

        /* ========== OVERLAY ========== */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 768px) {
            .sidebar-overlay {
                display: block;
            }
        }

        @yield('extra-styles')
    </style>
</head>
<body>

    {{-- Valider la session de connexion --}}
    @if (!Auth::check() || session('connected') !== true)
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif

    <div class="app-wrapper">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">B</div>
                <div>
                    <div class="sidebar-title">Bankati Pro</div>
                    <div class="sidebar-subtitle">Admin</div>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-menu-link @if(request()->route()->getName() === 'dashboard') active @endif">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('clients.index') }}" class="sidebar-menu-link @if(request()->route()->getName() === 'clients.index') active @endif">
                        <i class="fas fa-users"></i>
                        <span>Clients</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('comptes.index') }}" class="sidebar-menu-link @if(request()->route()->getName() === 'comptes.index') active @endif">
                        <i class="fas fa-wallet"></i>
                        <span>Comptes</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('virements.index') }}" class="sidebar-menu-link @if(request()->route()->getName() === 'virements.index') active @endif">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Virements</span>
                    </a>
                </li>

                <div class="sidebar-divider"></div>

                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ session('user_name') ?? 'Admin' }}</div>
                        <div class="user-role">Administrateur</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- SIDEBAR OVERLAY -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        <!-- TOP BAR -->
        <header class="topbar" id="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="breadcrumb">
                    @yield('breadcrumb', '<span>Dashboard</span>')
                </div>
            </div>

            <div class="topbar-right">
                <div class="topbar-actions">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn" title="Déconnexion">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="main-content" id="mainContent">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const topbar = document.getElementById('topbar');
            const mainContent = document.getElementById('mainContent');

            sidebar.classList.toggle('hidden');
            overlay.classList.toggle('active');
            topbar.classList.toggle('expand');
            mainContent.classList.toggle('expand');
        }

        // Close sidebar on link click (mobile)
        if (window.innerWidth <= 768) {
            document.querySelectorAll('.sidebar-menu-link').forEach(link => {
                link.addEventListener('click', () => {
                    const sidebar = document.getElementById('sidebar');
                    if (!sidebar.classList.contains('hidden')) {
                        toggleSidebar();
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('✅ Layout loaded successfully');
        });
    </script>

    @yield('extra-scripts')

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Gestion des Comptes</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #F6F7F9 0%, #FFFFFF 100%);
        }

        /* --- NAVBAR MODERNE --- */
        .navbar-modern {
            background: linear-gradient(135deg, #0A1F44 0%, #1A73E8 100%);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(10, 31, 68, 0.15);
            border-bottom: 3px solid #4DD0E1;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: #FFFFFF !important;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.3s ease;
        }
         .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #1a03e7ff, #001e72ff);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            text-decoration: none;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
            color: white;
        }


        .navbar-brand i {
            font-size: 28px;
            color: #4DD0E1;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-nav {
            gap: 10px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            font-size: 15px;
            padding: 10px 20px !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link i {
            font-size: 18px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(77, 208, 225, 0.2);
            color: #FFFFFF !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(77, 208, 225, 0.3);
        }

        .navbar-toggler {
            border: 2px solid #4DD0E1;
            padding: 8px 12px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(77, 208, 225, 0.25);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%234DD0E1' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* --- CONTAINER --- */
        .container {
            margin-top: 30px;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 991px) {
            .navbar-nav {
                margin-top: 15px;
                gap: 5px;
            }

            .nav-link {
                padding: 12px 15px !important;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-modern">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="bi bi-bank2"></i>
            Gestion Bancaire
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('comptes.index') }}">
                        <i class="bi bi-credit-card"></i>
                        Comptes
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}">
                        <i class="bi bi-people-fill"></i>
                        Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('virements.index') }}">
                        <i class="bi bi-arrow-left-right"></i>
                        Virements
                    </a>
                    </li>
                     <div class="topbar-right">
        <!-- Bouton de déconnexion qui redirige vers la page de connexion -->
        <a href="{{ route('login') }}" class="logout-btn">
            <span class="logout-icon">🚪</span>
            <span>Déconnexion</span>
        </a>
               
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<!-- Bootstrap JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar & Sidebar</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
      
        body {
            font-family: Arial, sans-serif;
        }
        
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: rgb(36, 0, 165);
            color: white;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            font-size: 16px;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: rgb(112, 7, 7);
            color: rgb(255, 255, 255);
        }
        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .navbar-brand {
            font-weight: bold;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }
        .content.collapsed {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .content {
                margin-left: 0;
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
        .navbar {
            background-color: rgb(112, 7, 7);
        }
        .content {
    background-image: url('image/WhatsApp Image 2025-01-15 à 02.51.28_6e1aa96d.jpg'); /* مسار الصورة */
    background-size: cover; /* تغطية كاملة للخلفية */
    background-position: center; /* توسيط الصورة */
    background-repeat: no-repeat; /* منع تكرار الصورة */
    min-height: 100vh; /* ارتفاع الشاشة بالكامل */
    padding: 20px; /* مسافة داخلية للمحتوى */
    color: white; /* لون النص */
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7); /* ظل للنص لزيادة الوضوح */
}
    </style>
</head>
<body>
 
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-clipboard-list"></i> Quiz Manager
            </a>
            <button class="navbar-toggler" type="button" id="sidebarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/application/index.php/accueil">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/application/formulaire">
                            <i class="fas fa-plus-circle"></i> Ajouter une équipe
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/application/simuler">
                            <i class="fas fa-gamepad"></i> Simuler un match
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/application/classement">
                            <i class="fas fa-chart-line"></i> Classement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/application/historique">
                            <i class="fas fa-history"></i> Historique des matchs
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="sidebar">
        <h4 class="text-center py-3">Menu</h4>
        <a href="http://localhost/application/index.php/accueil" class="active">
            <i class="fas fa-home"></i> Accueil
        </a>
        <a href="http://localhost/application/formulaire">
            <i class="fas fa-plus-circle"></i> Ajouter une équipe
        </a>
        <a href="http://localhost/application/simuler">
            <i class="fas fa-gamepad"></i> Simuler un match
        </a>
        <a href="http://localhost/application/classement">
            <i class="fas fa-trophy"></i> Classement
        </a>
        <a href="http://localhost/application/historique">
            <i class="fas fa-history"></i> Historique des matchs
        </a>
    </div>

    
    <div class="content">
    
    <div class="main-content flex-grow-1 p-4">
    <div class="text-center mb-5">
        <h1>Bienvenue sur League Manager</h1>
        <p class="lead">Découvrez le classement, simulez des matchs, et suivez l'historique des rencontres en temps réel !</p>
    </div>

    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-list-ol fa-3x text-primary mb-3"></i>
                    <h5 class="card-title text-dark">Classement</h5>
                    <p class="card-text text-dark">Consultez les classements actuels des équipes de la ligue.</p>
                    <a href="classement.php" class="btn btn-primary">Voir Classement</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-futbol fa-3x text-success mb-3"></i>
                    <h5 class="card-title text-dark">Simuler un Match</h5>
                    <p class="card-text text-dark">Consultez les scores et stats des matchs passés.</p>
                    <a href="simulate_match.php" class="btn btn-success">Simuler Maintenant</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-history fa-3x text-warning mb-3"></i>
                    <h5 class="card-title text-dark">Historique des Matches</h5>
                    <p class="card-text text-dark">Revenez sur les scores et statistiques des rencontres passées.</p>
                    <a href="historique.php" class="btn btn-warning">Voir Historique</a>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            content.classList.toggle('collapsed');
        });
    </script>
</body>
</html>

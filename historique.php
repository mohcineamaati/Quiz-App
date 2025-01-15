<?php

$host = 'localhost';
$dbname = 'app'; 
$username = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$historique = [];
try {
    // Fetch match history with team names, logos, and scores
    $stmt = $pdo->query("
        SELECT 
            m.id, 
            e1.nom AS equipe1, 
            e1.logo AS logo1, 
            e2.nom AS equipe2, 
            e2.logo AS logo2, 
            m.score_equipe1, 
            m.score_equipe2, 
            m.date_match
        FROM matches m
        JOIN equipes e1 ON m.equipe1_id = e1.id
        JOIN equipes e2 ON m.equipe2_id = e2.id
        ORDER BY m.date_match DESC
    ");
    $historique = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération de l'historique des matchs : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Matchs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, rgb(107, 0, 0), rgb(36, 0, 165));
            color: white;
        }
        h1 {
            color: white;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            color: black;
        }
        .table th, .table td {
            text-align: center;
        }
        .team-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .btn-primary {
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, rgb(231, 89, 0), rgb(112, 3, 3));
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Historique des Matchs</h1>

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Équipe 1</th>
                    <th>Logo</th>
                    <th>Score</th>
                    <th>Logo</th>
                    <th>Équipe 2</th>
                    <th>Date du Match</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historique as $index => $match): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($match['equipe1']) ?></td>
                        <td>
                            <?php if (!empty($match['logo1'])): ?>
                                <img src="<?= htmlspecialchars($match['logo1']) ?>" alt="Logo 1" class="team-logo">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= $match['score_equipe1'] ?> - <?= $match['score_equipe2'] ?></td>
                        <td>
                            <?php if (!empty($match['logo2'])): ?>
                                <img src="<?= htmlspecialchars($match['logo2']) ?>" alt="Logo 2" class="team-logo">
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($match['equipe2']) ?></td>
                        <td><?= $match['date_match'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="http://localhost/application/index.php/accueil#" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Retour à l'Accueil
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
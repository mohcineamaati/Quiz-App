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

try {
    
    $stmt = $pdo->query("SELECT id, nom, description, score_total, logo FROM equipes ORDER BY score_total DESC");
    $equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des équipes : " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement des équipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #004d98, #A31D1D);
        }
        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #A31D1D;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .table th, .table td {
            text-align: center;
        }
        .btn-primary {
            margin-top: 20px;
            border-radius: 20px;
            padding: 10px 20px;
        }
        .table-dark {
            background-color: rgb(102, 17, 17) !important;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        img {
            max-width: 50px;
            height: auto;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="table-container">
            <h1 class="text-center">Classement des équipes</h1>
            <table class="table table-striped table-bordered mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Rang</th>
                        <th>Nom de l'équipe</th>
                        <th>Logo</th>
                        <th>Description</th>
                        <th>Score total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($equipes)): ?>
                        <?php foreach ($equipes as $index => $equipe): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($equipe['nom']) ?></td>
                                <td>
    <?php if (!empty($equipe['logo'])): ?>
        <img src="<?= htmlspecialchars($equipe['logo']) ?>" alt="Logo" style="width: 50px; height: 50px;">
    <?php else: ?>
        N/A
    <?php endif; ?>
</td>
                                <td><?= htmlspecialchars($equipe['description']) ?></td>
                                <td><?= $equipe['score_total'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Aucune équipe trouvée</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
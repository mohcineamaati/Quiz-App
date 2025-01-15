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

$message = '';
$alertType = 'error'; // Default alert type

$equipes = [];
try {
    $stmt = $pdo->query("SELECT id, nom FROM equipes");
    $equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des équipes : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipe1_id = intval($_POST['equipe1']);
    $equipe2_id = intval($_POST['equipe2']);

    if ($equipe1_id === $equipe2_id) {
        $message = "Les deux équipes doivent être différentes.";
        $alertType = 'error';
    } else {
        $score_equipe1 = rand(0, 10);
        $score_equipe2 = rand(0, 10);

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO matches (equipe1_id, equipe2_id, score_equipe1, score_equipe2, date_match) 
                 VALUES (:equipe1_id, :equipe2_id, :score_equipe1, :score_equipe2, :date_match)"
            );
            $stmt->execute([
                ':equipe1_id' => $equipe1_id,
                ':equipe2_id' => $equipe2_id,
                ':score_equipe1' => $score_equipe1,
                ':score_equipe2' => $score_equipe2,
                ':date_match' => date('Y-m-d'),
            ]);

            $stmt = $pdo->prepare("UPDATE equipes SET score_total = score_total + :score WHERE id = :id");
            $stmt->execute([':score' => $score_equipe1, ':id' => $equipe1_id]);
            $stmt->execute([':score' => $score_equipe2, ':id' => $equipe2_id]);

            $equipe1_name = array_column($equipes, 'nom', 'id')[$equipe1_id] ?? "Équipe 1";
            $equipe2_name = array_column($equipes, 'nom', 'id')[$equipe2_id] ?? "Équipe 2";

            $message = "Match simulé avec succès ! 
                        {$equipe1_name} {$score_equipe1} - {$score_equipe2} {$equipe2_name}";
            $alertType = 'success';
        } catch (PDOException $e) {
            $message = 'Erreur lors de la simulation : ' . $e->getMessage();
            $alertType = 'error';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simuler un Match</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #004d98, #A31D1D);
            color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #ffffff;
            color: #333;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
        }
        h1 {
            font-size: 28px;
            color: rgb(107, 0, 0);
            font-weight: bold;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(135deg,rgb(107, 0, 0),rgb(36, 0, 165));
            border: none;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }
        .btn-secondary {
            border: none;
            background: #6c757d;
        }
        .form-select:focus {
            border-color: #2575fc;
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.3);
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1>Simuler un Match</h1>

        <form method="POST" action="" class="mt-4">
            <div class="mb-3">
                <label for="equipe1" class="form-label">Équipe 1</label>
                <select name="equipe1" id="equipe1" class="form-select" required>
                    <option value="" disabled selected>Choisir une équipe</option>
                    <?php foreach ($equipes as $equipe): ?>
                        <option value="<?= $equipe['id'] ?>"><?= $equipe['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="equipe2" class="form-label">Équipe 2</label>
                <select name="equipe2" id="equipe2" class="form-select" required>
                    <option value="" disabled selected>Choisir une équipe</option>
                    <?php foreach ($equipes as $equipe): ?>
                        <option value="<?= $equipe['id'] ?>"><?= $equipe['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simuler</button>
        </form>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Retour à l'Accueil</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        <?php if ($message): ?>
            Swal.fire({
                icon: '<?= $alertType ?>',
                title: '<?= $alertType === 'success' ? 'Succès' : 'Erreur' ?>',
                text: '<?= htmlspecialchars($message, ENT_QUOTES) ?>'
            });
        <?php endif; ?>
    </script>

</body>
</html>

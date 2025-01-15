<?php
include('db.php'); 

$success = false; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nom = $_POST['nom'];
    $description = $_POST['description'];  

    if (!empty($nom)) {
        
        $stmt = $pdo->prepare("INSERT INTO equipes (nom, description) VALUES (:nom, :description)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);

        
        if ($stmt->execute()) {
            $success = true; // Success
        } else {
            $error = "Erreur lors de l'ajout de l'équipe.";
        }
    } else {
        $error = "Le nom de l'équipe est obligatoire.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une équipe</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #004d98, #A31D1D);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: rgb(112, 3, 3);
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            margin: 10px 0 5px;
            text-align: left;
            color: #555;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus, textarea:focus {
            border-color: #ff2e63;
            box-shadow: 0 0 8px rgba(255, 46, 99, 0.2);
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: #fff;
            background: linear-gradient(135deg,rgb(107, 0, 0),rgb(36, 0, 165));
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg,rgb(231, 89, 0),rgb(112, 3, 3));
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #ff2e63;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Ajouter une équipe</h1>
        <form method="POST">
            <label for="nom">Nom de l'équipe :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="description">Description de l'équipe :</label>
            <textarea id="description" name="description" placeholder="Optionnel..."></textarea>

            <button type="submit">Ajouter l'équipe</button>
        </form>

        <a href="index.php">Retour à la liste des équipes</a>
    </div>

    <?php if (isset($error)): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '<?= $error ?>'
            });
        </script>
    <?php elseif ($success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'L\'équipe a été ajoutée avec succès!'
            }).then(() => {
                window.location = 'index.php';
            });
        </script>
    <?php endif; ?>
</body>
</html>

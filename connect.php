<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$db   = 'gestion_comptable';
$user = 'root';
$pass = 'Ma@224mkante036';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Récupération des données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Requête pour vérifier les informations d'identification
$stmt = $pdo->prepare('SELECT id, password FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    // Démarrer la session et stocker l'ID de l'utilisateur
    $_SESSION['user_id'] = $user['id'];

    // Rediriger vers une autre page
    header('Location: Accueil.html');
    exit();
} else {
    // Afficher un message d'erreur
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <div class="logo">
            <!-- Remplacez "logo.png" par le chemin de votre logo -->
            <img src="logo.jpg" alt="Logo">
        </div>
        <h2 class="text-center mb-4">Connexion</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label" style="display: inline-block; width: 100px;">Username:</label>
                <input type="text" class="form-control" id="username" name="username" style="display: inline-block; width: 235px;"  placeholder="Entrez votre email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" style="display: inline-block; width: 100px;">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" style="display: inline-block; width: 235px;" type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe">
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button></br></br>
			<a href="register.php">S'inscrire</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS (optionnel, seulement si vous avez besoin des fonctionnalités JS de Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

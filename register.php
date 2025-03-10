<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'gestion_comptable';
$username = 'root';
$password = 'Ma@224mkante036';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération des données du formulaire
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash du mot de passe

// Insertion des données dans la base de données
$sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);

if ($stmt->execute()) {
    // Démarrer une session pour l'utilisateur
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    // Redirection vers une autre page
    header('Location: connect.php');
    exit();
} else {
    echo "Erreur lors de l'inscription.";
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
        <h2 class="text-center mb-4">Inscription</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label" style="display: inline-block; width: 100px;">Username:</label>
                <input type="text" class="form-control" id="username" name="username" style="display: inline-block; width: 235px;"  placeholder="Entrez votre nom utilisateur">
            </div>
			<div class="mb-3">
                <label for="email" class="form-label" style="display: inline-block; width: 100px;">Email::</label>
                <input type="email" class="form-control" id="eamil" name="email" style="display: inline-block; width: 235px;"  placeholder="Entrez votre email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" style="display: inline-block; width: 100px;">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" style="display: inline-block; width: 235px;" type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe">
            </div>
            <button type="submit" class="btn btn-primary w-100">S'inscrire</button></br></br>
        </form>
    </div>
</div>

<!-- Bootstrap JS (optionnel, seulement si vous avez besoin des fonctionnalités JS de Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

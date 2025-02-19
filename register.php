<?php
require 'index.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email]);

    echo "Inscription réussie!";
	header('Location: connect.php');
    exit();
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
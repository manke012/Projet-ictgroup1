<?php


require 'index.php';



// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=gestion_comptable', 'root', '');

// Vérifier le nombre total d'utilisateurs
$stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_users = $row['total_users'];

// Limite d'utilisateurs
$user_limit = 5;

if ($total_users >= $user_limit) {
    die("Le nombre maximal d'utilisateurs est atteint. Impossible de créer un nouveau compte.");
}

// Créer un nouvel utilisateur
// ...

?>

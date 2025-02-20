<?php
$host = 'localhost';
$dbname = 'gestion_comptable';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    header('Location: connect.php');
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

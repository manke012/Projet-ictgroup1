<?php
$host = 'localhost';
$dbname = 'gestion_comptable';
$username = 'root';
$password = 'Ma@224mkante036';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>

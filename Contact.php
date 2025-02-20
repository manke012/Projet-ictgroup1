<?php

require 'index.php';


// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "Ma@224mkante036";
$dbname = "gestion_comptable";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialiser les variables et les messages d'erreur
$name = $email = $sujet = $message = "";
$nameErr = $emailErr = $sujetErr = $messageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation du nom
    if (empty($_POST["name"])) {
        $nameErr = "Le nom est requis";
    } else {
        $name = test_input($_POST["name"]);
        // Vérifier si le nom contient uniquement des lettres et des espaces
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Seules les lettres et les espaces blancs sont autorisés";
        }
    }

    // Validation de l'email
    if (empty($_POST["email"])) {
        $emailErr = "L'email est requis";
    } else {
        $email = test_input($_POST["email"]);
        // Vérifier si l'email est bien formaté
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format d'email invalide";
        }
    }
	// Validation du sujet
    if (empty($_POST["sujet"])) {
        $sujetErr = "Le sujet est requis";
    } else {
        $sujet = test_input($_POST["sujet"]);
        // Vérifier si le nom contient uniquement des lettres et des espaces
        if (!preg_match("/^[a-zA-Z-' ]*$/",$sujet)) {
            $sujetErr = "Seules les lettres et les espaces blancs sont autorisés";
        }
    }

    // Validation du message
    if (empty($_POST["message"])) {
        $messageErr = "Le message est requis";
    } else {
        $message = test_input($_POST["message"]);
    }

    // Si aucune erreur, insérer dans la base de données
    if (empty($nameErr) && empty($emailErr) && empty($sujetErr) && empty($messageErr)) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, sujet, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $email, $message);

        if ($stmt->execute()) {
            echo "Nouvel enregistrement créé avec succès";
        } else {
            echo "Erreur: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();

// Fonction pour nettoyer et valider les données
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil avec Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Votre contenu ici -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Compta-Expert</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Accueil.html">Accueil</a>
                </li> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Structure
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Plan Comptable</a></li>
                        <li><a class="dropdown-item" href="#">Plan Tiers</a></li>
                        <li><a class="dropdown-item" href="#">Codes Journaux</a></li>
                    </ul>
                </li>
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Traitement
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">SAISIE ECRITURE</a></li>
                        <li><a class="dropdown-item" href="#">ONG</a></li>
                        <li><a class="dropdown-item" href="#">PROJET</a></li>
						<li><a class="dropdown-item" href="#">DONATEUR</a></li>
                    </ul>
                </li>
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Etat
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Journal</a></li>
                        <li><a class="dropdown-item" href="#">Compte de Résultat</a></li>
                        
                    </ul>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="#">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Contact.php">Contact</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
 
    <div class="container mt-5">
        <h2 class="text-center mb-4">Contactez l'Administrateur </h2>
        <form method="POST">
            <!-- Champ Nom -->
            <div class="mb-3">
                <label for="nom" class="form-label" style="display: inline-block; width: 100px;">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom" style="display: inline-block; width: 200px;" required>
            </div>

            <!-- Champ Email -->
            <div class="mb-3">
                <label for="email" class="form-label" style="display: inline-block; width: 100px;">Adresse Email</label>
                <input type="email" class="form-control" id="email" placeholder="Entrez votre email" style="display: inline-block; width: 230px;" required>
            </div>

            <!-- Champ Sujet -->
            <div class="mb-3">
                <label for="sujet" class="form-label" style="display: inline-block; width: 100px;">Sujet</label>
                <input type="text" class="form-control" id="sujet" placeholder="Entrez le sujet de votre message" style="display: inline-block; width: 250px;" required>
            </div>

            <!-- Champ Message -->
            <div class="mb-3">
                <label for="message" class="form-label" style="display: inline-block; width: 100px;">Message</label>
                <textarea class="form-control" id="message" rows="5" placeholder="Entrez votre message" style="display: inline-block; width: 500px;" required></textarea>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <!-- Bootstrap JS (optionnel, pour les fonctionnalités avancées) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

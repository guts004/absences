<?php
// Paramètres de connexion à la base de données
$servername = "localhost"; // Adresse du serveur MySQL
$username = "test"; // Nom d'utilisateur MySQL
$password = "hamzaikhibi200204"; // Mot de passe MySQL
$database = "gestion_classes"; // Nom de la base de données

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}
?>

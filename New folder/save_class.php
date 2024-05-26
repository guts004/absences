<?php
// Configuration de la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "gestion_classes";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom_class = $_POST['nom_class'];
$niveau = $_POST['niveau'];

// Préparer et exécuter la requête d'insertion
$stmt = $conn->prepare("INSERT INTO classes (nom_class, niveau) VALUES (?, ?)");
$stmt->bind_param("ss", $nom_class, $niveau);

if ($stmt->execute()) {
    echo "Nouvelle classe créée avec succès.";
} else {
    echo "Erreur: " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

<?php
// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_classes";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$date_naissance = $_POST['date_naissance'];
$numero_tele = $_POST['numero_tele'];
$email = $_POST['email'];
$filiere = $_POST['filiere'];
$id_classe = $_POST['id_classe'];

// Préparer et exécuter la requête d'insertion
$stmt = $conn->prepare("INSERT INTO etudiants (nom, prenom, date_naissance, numero_tele, email, filiere, id_classe) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssi", $nom, $prenom, $date_naissance, $numero_tele, $email, $filiere, $id_classe);

if ($stmt->execute()) {
    echo "Nouvel étudiant ajouté avec succès.";
} else {
    echo "Erreur: " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

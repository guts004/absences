<?php
// Vérifie si le formulaire de signup a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure la connexion à la base de données
    include_once "db_connection.php";

    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirm_password) {
        // Rediriger avec un message d'erreur si les mots de passe ne correspondent pas
        header("Location: signup.php?error=2");
        exit();
    }

    // Hacher le mot de passe
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Requête SQL pour insérer les données dans la table des utilisateurs
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

    // Préparation de la requête
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Liaison des paramètres et exécution de la requête
        $stmt->bind_param("sss", $username, $email, $password_hash);
        $stmt->execute();

        // Vérification de l'insertion réussie
        if ($stmt->affected_rows > 0) {
            // Utilisateur inscrit avec succès, rediriger vers la page index
            header("Location: index.php");
            exit();
        } else {
            // Erreur lors de l'inscription, rediriger avec un message d'erreur
            header("Location: signup.php?error=1");
            exit();
        }
    } else {
        // Erreur lors de la préparation de la requête, rediriger avec un message d'erreur
        header("Location: signup.php?error=1");
        exit();
    }

    // Fermer la déclaration et la connexion à la base de données
    $stmt->close();
    $conn->close();
} else {
    // Rediriger vers la page de signup si le formulaire n'a pas été soumis
    header("Location: signup.php");
    exit();
}
?>

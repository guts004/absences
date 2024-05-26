<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'gestion_classes');
if ($conn->connect_error) {
    die('La connexion a échoué: ' . $conn->connect_error);
}

if (isset($_POST['id_etudiant'], $_POST['date_absence'], $_POST['justifie'])) {
    $id_etudiant = $_POST['id_etudiant'];
    $date_absence = $_POST['date_absence'];
    $justifie = $_POST['justifie'] === 'oui' ? 1 : 0;
    $justification = isset($_POST['justification']) ? $_POST['justification'] : '';

    // Préparer et exécuter la requête d'insertion
    $stmt = $conn->prepare('INSERT INTO absences (id_etudiant, date_absence, justifie, justification) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('isis', $id_etudiant, $date_absence, $justifie, $justification);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'Absence ajoutée avec succès.';
    } else {
        echo 'Erreur lors de l\'ajout de l\'absence.';
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
} else {
    echo 'Veuillez remplir tous les champs.';
}
?>

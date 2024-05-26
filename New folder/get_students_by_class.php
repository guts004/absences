<?php
// Vérifier si l'ID de la classe est fourni dans la requête
if (isset($_GET['class_id'])) {
    // Récupérer l'ID de la classe depuis la requête
    $classId = intval($_GET['class_id']);

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'gestion_classes');
    if ($conn->connect_error) {
        die('La connexion a échoué: ' . $conn->connect_error);
    }

    // Préparer la requête SQL pour récupérer les étudiants de la classe spécifiée
    $stmt = $conn->prepare('SELECT id, nom, prenom FROM etudiants WHERE id_classe = ?');
    $stmt->bind_param('i', $classId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Créer un tableau associatif des étudiants
    $students = [];
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();

    // Renvoyer les étudiants au format JSON
    header('Content-Type: application/json');
    echo json_encode($students);
} else {
    echo json_encode([]);
}
?>

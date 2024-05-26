<?php
// Vérifier si l'ID de la classe est fourni dans la requête
if (isset($_GET['class_id'])) {
    // Récupérer l'ID de la classe depuis la requête
    $classId = $_GET['class_id'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'gestion_classes');
    if ($conn->connect_error) {
        die('La connexion a échoué: ' . $conn->connect_error);
    }

    // Préparer la requête SQL pour récupérer les étudiants de la classe spécifiée
    $stmt = $conn->prepare('SELECT nom, prenom, date_naissance, numero_tele, email, filiere FROM etudiants WHERE id_classe = ?');
    $stmt->bind_param('i', $classId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Afficher les étudiants dans un tableau HTML
    if ($result->num_rows > 0) {
        echo '<h2>Étudiants de la Classe</h2>';
        echo '<table>';
        echo '<thead><tr><th>Nom</th><th>Prénom</th><th>Date de Naissance</th><th>Numéro de Téléphone</th><th>Email</th><th>Filière</th></tr></thead>';
        echo '<tbody>';
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['nom'] . '</td>';
            echo '<td>' . $row['prenom'] . '</td>';
            echo '<td>' . $row['date_naissance'] . '</td>';
            echo '<td>' . $row['numero_tele'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['filiere'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'Aucun étudiant dans cette classe.';
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
} else {
    echo 'ID de classe non spécifié.';
}
?>

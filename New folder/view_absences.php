<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir les Absences</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Voir les Absences</h1>
    <form method="GET" action="">
        <label for="date_absence">Choisir une date :</label>
        <input type="date" id="date_absence" name="date_absence" required>
        <input type="hidden" name="class_id" value="<?php echo $_GET['class_id']; ?>">
        <button type="submit">Voir les absences</button>
    </form>

    <?php
    if (isset($_GET['date_absence']) && isset($_GET['class_id'])) {
        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', '', 'gestion_classes');
        if ($conn->connect_error) {
            die('La connexion a échoué: ' . $conn->connect_error);
        }

        // Récupérer les absences pour la classe et la date spécifiées
        $date_absence = $_GET['date_absence'];
        $class_id = intval($_GET['class_id']);
        $stmt = $conn->prepare('SELECT etudiants.id, etudiants.nom, etudiants.prenom, absences.justifie, absences.justification 
                                FROM absences 
                                JOIN etudiants ON absences.id_etudiant = etudiants.id 
                                WHERE etudiants.id_classe = ? AND absences.date_absence = ?');
        $stmt->bind_param('is', $class_id, $date_absence);
        $stmt->execute();
        $result = $stmt->get_result();

        // Afficher les absences dans un tableau HTML
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<thead><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Justifié</th><th>Justification</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nom'] . '</td>';
                echo '<td>' . $row['prenom'] . '</td>';
                echo '<td>' . ($row['justifie'] ? 'Oui' : 'Non') . '</td>';
                echo '<td>' . $row['justification'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>Aucune absence trouvée pour cette date.</p>';
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>

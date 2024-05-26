<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Étudiant</title>
</head>
<body>
    <h1>Ajouter un Étudiant</h1>
    <form action="save_student.php" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
        <br>
        <label for="date_naissance">Date de Naissance:</label>
        <input type="date" id="date_naissance" name="date_naissance" required>
        <br>
        <label for="numero_tele">Numéro de Téléphone:</label>
        <input type="text" id="numero_tele" name="numero_tele">
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <br>
        <label for="filiere">Filière:</label>
        <input type="text" id="filiere" name="filiere" required>
        <br>
        <label for="id_classe">Classe:</label>
        <select id="id_classe" name="id_classe" required>
            <?php
            // Connexion à la base de données
            $conn = new mysqli('localhost', 'root', '', 'gestion_classes');
            if ($conn->connect_error) {
                die('La connexion a échoué: ' . $conn->connect_error);
            }

            // Récupérer les classes depuis la base de données
            $result = $conn->query('SELECT id, nom_class FROM classes');
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['nom_class'] . '</option>';
                }
            } else {
                echo '<option value="">Aucune classe disponible</option>';
            }
            $conn->close();
            ?>
        </select>
        <br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Absence</title>
</head>
<body>
    <h1>Ajouter une Absence</h1>
    <form action="save_absence.php" method="post">
        <label for="class_id">Classe :</label>
        <select id="class_id" name="class_id" onchange="loadStudents(this.value)" required>
            <option value="">Sélectionnez une classe</option>
            <?php
            // Connexion à la base de données
            $conn = new mysqli('localhost', 'root', '', 'gestion_classes');
            if ($conn->connect_error) {
                die('La connexion a échoué: ' . $conn->connect_error);
            }

            // Récupérer les classes
            $result = $conn->query('SELECT id, nom_class FROM classes');
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['nom_class'] . '</option>';
            }

            // Fermer la connexion
            $conn->close();
            ?>
        </select>
        <br>
        <label for="id_etudiant">Étudiant :</label>
        <select id="id_etudiant" name="id_etudiant" required>
            <option value="">Sélectionnez un étudiant</option>
            <!-- Les étudiants seront chargés ici via JavaScript -->
        </select>
        <br>
        <label for="date_absence">Date d'absence :</label>
        <input type="date" id="date_absence" name="date_absence" required>
        <br>
        <label>Justifié :</label>
        <input type="radio" id="justifie_oui" name="justifie" value="oui" required> Oui
        <input type="radio" id="justifie_non" name="justifie" value="non" required> Non
        <br>
        <label for="justification">Justification :</label>
        <textarea id="justification" name="justification"></textarea>
        <br>
        <button type="submit">Ajouter l'absence</button>
    </form>

    <script>
        function loadStudents(classId) {
            var studentSelect = document.getElementById('id_etudiant');
            studentSelect.innerHTML = '<option value="">Sélectionnez un étudiant</option>';

            if (classId) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var students = JSON.parse(xhr.responseText);
                            students.forEach(function(student) {
                                var option = document.createElement('option');
                                option.value = student.id;
                                option.textContent = student.nom + ' ' + student.prenom;
                                studentSelect.appendChild(option);
                            });
                        }
                    }
                };
                xhr.open('GET', 'get_students_by_class.php?class_id=' + classId, true);
                xhr.send();
            }
        }
    </script>
</body>
</html>

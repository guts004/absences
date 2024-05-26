<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Classes</title>
    <style>
        /* Styles pour les tableaux */
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
        /* Style pour les lignes survolées */
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <script>
        // Fonction pour charger les étudiants d'une classe via AJAX
        function loadStudents(classId) {
            var studentsDiv = document.getElementById('students');
            studentsDiv.innerHTML = ''; // Clear previous content

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var students = JSON.parse(xhr.responseText);
                        var html = '<h2>Étudiants de la classe ' + classId + '</h2>';
                        if (students.length > 0) {
                            html += '<table>';
                            html += '<thead><tr><th>ID</th><th>Nom</th><th>Prénom</th></tr></thead>';
                            html += '<tbody>';
                            students.forEach(function(student) {
                                html += '<tr>';
                                html += '<td>' + student.id + '</td>';
                                html += '<td>' + student.nom + '</td>';
                                html += '<td>' + student.prenom + '</td>';
                                html += '</tr>';
                            });
                            html += '</tbody></table>';
                        } else {
                            html += '<p>Aucun étudiant trouvé pour cette classe.</p>';
                        }
                        studentsDiv.innerHTML = html;
                    } else {
                        studentsDiv.innerHTML = 'Une erreur s\'est produite lors du chargement des étudiants.';
                    }
                }
            };
            xhr.open('GET', 'get_students_by_class.php?class_id=' + classId, true);
            xhr.send();
        }
    </script>
</head>
<body>
    <h1>Liste des Classes</h1>
    <?php
    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'gestion_classes');
    if ($conn->connect_error) {
        die('La connexion a échoué: ' . $conn->connect_error);
    }

    // Récupérer les classes et le nombre d'étudiants absents depuis la base de données
    $result = $conn->query('SELECT classes.id, classes.nom_class, classes.niveau, COUNT(absences.id) AS absences_count 
                            FROM classes 
                            LEFT JOIN etudiants ON classes.id = etudiants.id_classe 
                            LEFT JOIN absences ON etudiants.id = absences.id_etudiant 
                            GROUP BY classes.id');

    // Afficher les classes et le nombre d'absences dans un tableau HTML
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nom de la Classe</th>';
    echo '<th>Niveau</th>';
    echo '<th>Absences</th>'; // Nouvelle colonne pour les absences
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td><a href="javascript:void(0);" onclick="loadStudents(' . $row['id'] . ');">' . $row['nom_class'] . '</a></td>';
        echo '<td>' . $row['niveau'] . '</td>';
        echo '<td><a href="view_absences.php?class_id=' . $row['id'] . '">Voir absences</a></td>'; // Lien vers la page des absences
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    // Fermer la connexion
    $conn->close();
    ?>
    <div id="students">
        <!-- Les étudiants seront chargés ici via AJAX -->
    </div>
</body>
</html>

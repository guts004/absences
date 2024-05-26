<?php
// Vérifie si le formulaire de login a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de connexion à la base de données
    include_once "db_connection.php";

    // Récupérer les données du formulaire de login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Requête SQL pour récupérer les informations de l'utilisateur à partir de son nom d'utilisateur
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    // Préparation de la requête
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Liaison des paramètres et exécution de la requête
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Récupérer le résultat de la requête
        $result = $stmt->get_result();

        // Vérifier si l'utilisateur existe dans la base de données
        if ($result->num_rows > 0) {
            // Récupérer les données de l'utilisateur
            $row = $result->fetch_assoc();
            $hashed_password = $row["password"];

            // Vérifier si le mot de passe correspond
            if (password_verify($password, $hashed_password)) {
                // Les informations de connexion sont correctes, rediriger vers la page d'accueil (index)
                header("Location: index.php");
                exit();
            } else {
                // Mot de passe incorrect, afficher un message d'erreur
                $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            // Utilisateur non trouvé, afficher un message d'erreur
            $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
        }

        // Fermer la déclaration
        $stmt->close();
    } else {
        // Erreur lors de la préparation de la requête, afficher un message d'erreur
        $error_message = "Erreur lors de la connexion. Veuillez réessayer.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error-message {
            color: red;
        }
        .link {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php
        // Afficher un message d'erreur s'il y a eu une erreur de connexion
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Se connecter</button>
        </form>
        <a href="signup.php" class="link">Pas encore inscrit ? Créez un compte</a>
    </div>
</body>
</html>

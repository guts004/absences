<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Classes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 8px 16px;
        }
        nav a:hover {
            background-color: #575757;
            border-radius: 4px;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 70px); /* Subtract the height of the header */
        }
        .button {
            display: inline-block;
            padding: 15px 25px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="login.php">Login</a>
            <a href="signup.php">Sign Up</a>
            <a href="about.php">About</a>
        </nav>
    </header>
    <div class="container">
        <h1>Gestion des Classes</h1>
        <a href="add_class.php" class="button">Ajouter une Classe</a>
        <a href="add_student.php" class="button">Ajouter un Étudiant</a>
        <a href="view_classes.php" class="button">Afficher les Classes</a>
        <a href="add_absence.php" class="button">Ajouter une Absence</a>
    </div>
</body>
</html>

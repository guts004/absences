<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }
        .container {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin: 10px 0;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .button {
            padding: 10px 20px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password !== confirmPassword) {
                document.getElementById("error_message").textContent = "Les mots de passe ne correspondent pas.";
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="signup_process.php" method="post" onsubmit="return validateForm();">
            <div class="input-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="button">S'inscrire</button>
            <p id="error_message" class="error">
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 1) {
                        echo "Erreur lors de l'inscription. Veuillez réessayer.";
                    } elseif ($_GET['error'] == 2) {
                        echo "Les mots de passe ne correspondent pas.";
                    }
                }
                ?>
            </p>
        </form>
    </div>
</body>
</html>

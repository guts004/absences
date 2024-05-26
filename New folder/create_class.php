<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Classe</title>
</head>
<body>
    <h1>Créer une Classe</h1>
    <form action="save_class.php" method="post">
        <label for="nom_class">Nom de la Classe:</label>
        <input type="text" id="nom_class" name="nom_class" required>
        <br>
        <label for="niveau">Niveau:</label>
        <select id="niveau" name="niveau" required>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
            <option value="S4">S4</option>
            <option value="S5">S5</option>
            <option value="S6">S6</option>
        </select>
        <br>
        <button type="submit">Créer</button>
    </form>
</body>
</html>

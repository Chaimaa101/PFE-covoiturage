<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES ('$nom', '$email', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <form method="POST" action="">
        Nom: <input type="text" name="nom" required><br>
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="mot_de_passe" required><br>
        Role: 
        <select name="role" required>
            <option value="passager">Passager</option>
            <option value="conducteur">Conducteur</option>
        </select><br>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>

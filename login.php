<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM utilisateurs WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'passager') {
                header("Location: passager_dashboard.php");
            } elseif ($user['role'] == 'conducteur') {
                header("Location: conducteur_dashboard.php");
            } else {
                echo "Rôle utilisateur non reconnu.";
            }
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <form method="POST" action="">
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="password" required><br>
        <button type="submit">Connexion</button>
    </form>
</body>
</html>

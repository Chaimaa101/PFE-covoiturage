<?php

require_once '../connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    
    $sql = "SELECT * FROM utilisateurs WHERE email='$email'";
    
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            if ($remember_me) {
                setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie('user_role', $user['role'], time() + (86400 * 30), "/");
                setcookie('user_nom', $user['nom'], time() + (86400 * 30), "/");
                setcookie('user_prenom', $user['prenom'], time() + (86400 * 30), "/");
            }
            if ($user['role'] == 'passager') {
                header("Location: ../ajoutertrajet.php?success=1");
            } elseif ($user['role'] == 'conducteur') {
                header("Location: ../trajetsannonces.php?success=1");
             } elseif ($user['role'] == 'administrateur') {
                header("Location: ../admin.php?success=1");
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <title>LOGIN</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <style>
         body{
           
    background: linear-gradient(to right, #9face6, #74ebd5);
    background-size: cover;
 
        }
        
    </style>
</head>
<body>
    
    <div class="main">
<?php
    if (isset($_GET['success']) && $_GET['success'] == '1') {
        echo "<p style='color:green;'>Création de compte réussie ! Vous pouvez maintenant vous connecter.</p>";
    }
    ?>
        <section class="signup">
        
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Se connecter</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="email" id="email" placeholder="email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="mot_de_passe" id="password" placeholder="Mot de passe"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="oublier" id="oublier" class="agree-term" />
                            <label for="oublier" class="label-agree-term"><a href="">Mot de Passe Oublié? </a></label>
                        <div class="form-group">
                            <input type="checkbox" name="remember_me" id="remember_me" class="agree-term" />
                            <label for="remember_me" class="label-agree-term"><span><span></span></span>Se souvenir de moi </label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" id="submit" class="form-submit" value="se connecter"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        créer un compte ? <a href="register.php" class="loginhere-link">s'inscrire</a>
                    </p>
                </div>
            </div>
        </section>

    </div>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
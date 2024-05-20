<?php 
require_once '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $telephone = $_POST['tel'];
    $adresse = $_POST['adress'];
    $date_naissance = $_POST['date_naissance'];

    
     $stmt = $conn->prepare(" INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, telephone, adresse, date_naissance) VALUES (?, ?, ?, ?,?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erreur de préparation de la requête: " . $conn->error);
    }

    // Lie les paramètres
    $stmt->bind_param("ssssssss",$nom, $prenom, $email, $mot_de_passe, $role, $telephone, $adresse, $date_naissance);

    // Exécute la requête
    if ($stmt->execute()) {
        header('location: login.php');
    } else {
        echo "Erreur: " . $stmt->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
           
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Inscriptione</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="nom" id="name" placeholder="Nom" require/>
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-input" name="prenom" id="surname" placeholder="Prènom" require/>
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-input" name="tel" id="phone" placeholder="Téléphone" require/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Email" require/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="mot_de_passe" id="password" placeholder="Mot de passe" require/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                             <input type="text" class="form-input" name="adress" id="adress" placeholder="Adresse" require/>
                        </div>
                        <div class="form-group">
                             <input type="date" class="form-input" name="date_naissance" id="date_naissance" placeholder="Date de naissance" require/>
                        </div>
                        <div class="form-group" >
                            <select class="form-input" name="role" id="role" placeholder="Rôle" required>
                                <option class="form-input" value="passager">Passager</option>
                                <option  class="form-input" value="conducteur">Conducteur</option>
                                <option  class="form-input" value="administrateur">Administrateur</option>
        </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" id="submit" class="form-submit" value="S'inscrire"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Vous avez déjà un compte? <a href="login.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
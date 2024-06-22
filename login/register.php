<?php 
require_once '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $telephone = $_POST['tel'];
    $adresse = $_POST['adress'];
    $date_naissance = $_POST['date_naissance'];
    $role = $_GET['role']; // Get the role from the URL
    $hasError = false;

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Format d'e-mail non valide";
        $hasError = true;
    }

    // Validate phone
    if (!preg_match("/^\d{10}$/", $telephone)) {
        $phoneError = "Numéro de téléphone invalide";
        $hasError = true;
    }

    // Validate password
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $mot_de_passe)) {
        $passwordError = "Mot de passe invalide";
        $hasError = true;
    }

    if (!$hasError) {
        // Hash the password
        $hashed_password = password_hash($mot_de_passe, PASSWORD_BCRYPT);

        if ($role == 'passager') {
            $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, telephone, adresse, date_naissance) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $nom, $prenom, $email, $hashed_password, $role, $telephone, $adresse, $date_naissance);
        } elseif ($role == 'conducteur' && isset($_POST['voiture'])) {
            $voiture = $_POST['voiture'];
            $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, telephone, adresse, date_naissance, voiture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $nom, $prenom, $email, $hashed_password, $role, $telephone, $adresse, $date_naissance, $voiture);
        }

        if (isset($stmt) && $stmt->execute()) {
            header('Location: login.php?success=1');
            exit();
        } else {
            echo "Erreur: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S'inscrire</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .error {
            color: red;
        }
        body{
           
    background: linear-gradient(to right, #e0dede, #82c1cc);
    background-size: cover;
 
        }
        
</style>
<body>
<div class="container-fluid">
    <div class="main" >

        <section class="signup" >
           
            <div class="container" >
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Inscription</h2>
                        <div class="form-group">
                            
                            <input type="text" class="form-input" name="nom" id="name"  placeholder="Nom" required/>
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-input" name="prenom" id="surname" placeholder="Prènom" required/>
                        </div>
                         <div class="form-group">
                            <span class="error"><?php echo $phoneError ?? ''; ?></span>
                            <input type="text" class="form-input" name="tel" id="phone" placeholder="Téléphone" required/>
                        </div>
                        <div class="form-group">
                             <span class="error"><?php echo $emailError ?? ''; ?></span>
                            <input type="email" class="form-input" name="email" id="email" placeholder="Email" required/>
                        </div>
                        <div class="form-group">
                             <span class="error"><?php echo $passwordError ?? ''; ?></span>
                            <input type="text" class="form-input" name="mot_de_passe" id="password" placeholder="Mot de passe" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                             <input type="text" class="form-input" name="adress" id="adress" placeholder="Adresse" required/>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-input" name="date_naissance" id="date_naissance" placeholder="Date de naissance" required/>
                        </div>
                        <?php if (isset($_GET['role']) && $_GET['role'] == 'conducteur') {?>
                        <div class="form-group">
                            <input type="text" class="form-input" name="voiture" id="voiture" placeholder="voiture" required/>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-input" name="date_naissance" id="date_naissance" placeholder="Date de naissance" required/>
                        </div>
                        <?php }?>
                        <div class="form-group">
                            <input type="submit" name="register" id="submit" class="form-submit" value="S'inscrire"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Vous avez déjà un compte? <a href="login.php" class="loginhere-link">Se connecter ici</a>
                    </p>
                </div>
            </div>
        </section>

    </div>
</div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
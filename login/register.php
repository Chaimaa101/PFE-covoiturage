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

        // Insertion dans la table utilisateurs
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, telephone, adresse, date_naissance) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nom, $prenom, $email, $hashed_password, $role, $telephone, $adresse, $date_naissance);

        if ($stmt->execute()) {
            // Récupérer l'ID de l'utilisateur inséré
            $utilisateur_id = $stmt->insert_id;

            if ($role == 'conducteur' && isset($_POST['voiture'], $_POST['marque'], $_POST['matricule'], $_POST['annee'], $_POST['couleur'], $_POST['prix_km'])) {
                // Récupération des informations de la voiture
                $voiture = $_POST['voiture'];
                $marque = $_POST['marque'];
                $matricule = $_POST['matricule'];
                $annee = $_POST['annee'];
                $couleur = $_POST['couleur'];
                $prix_km = $_POST['prix_km'];

                // Préparation de l'insertion dans la table voitures
                $stmt_voiture = $conn->prepare("INSERT INTO voitures (conducteur_id, modele, marque, annee, couleur, prix_km) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt_voiture->bind_param("issss", $utilisateur_id, $voiture, $marque, $annee, $couleur, $prix_km);

                if ($stmt_voiture->execute()) {
                    header('Location: login.php?success=1');
                    exit();
                } else {
                    echo "Erreur lors de l'enregistrement de la voiture : " . $stmt_voiture->error;
                }

                $stmt_voiture->close();
            } else {
                header('Location: login.php?success=1');
                exit();
            }
        } else {
            echo "Erreur lors de l'enregistrement de l'utilisateur : " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S'inscrire</title>
    <link rel="shortcut icon" href="../img/logoblue.png" type="image/png">
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .error {
        color: red;
    }
    body {
        background: linear-gradient(to right, #e0dede, #82c1cc);
        background-size: cover;
    }
    .hidden {
        display: none;
    }
</style>
<body>
<div class="container-fluid">
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Inscription</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="nom" id="name" placeholder="Nom" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="prenom" id="surname" placeholder="Prénom" required/>
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
                            <input type="password" class="form-input" name="mot_de_passe" id="password" placeholder="Mot de passe" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="adress" id="adress" placeholder="Adresse" required/>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-input" name="date_naissance" id="date_naissance" placeholder="Date de naissance" required/>
                        </div>
                        <?php if (isset($_GET['role']) && $_GET['role'] == 'conducteur') { ?>
                        
                        <div id="car-info" class="hidden">
                            <div class="form-group">
                                <input type="text" class="form-input" name="voiture" id="voiture" placeholder="Voiture" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="marque" id="marque" placeholder="Marque" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="matricule" id="matricule" placeholder="Matricule" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="annee" id="annee" placeholder="Année" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="couleur" id="couleur" placeholder="Couleur" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="prix_km" id="prix_km" placeholder="Prix/km" required/>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <input type="submit" name="register" id="submit" class="form-submit" value="S'inscrire"/>
                        </div>
                        <button id="next-btn" class="button" onclick="showCarInfo()">Suivant</button>
                    </form>
                    <p class="loginhere">
                        Vous avez déjà un compte? <a href="login.php" class="loginhere-link">Se connecter ici</a>
                    </p>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    function showCarInfo() {
        document.getElementById('car-info').classList.remove('hidden');
        document.getElementById('next-btn').classList.add('hidden');
    }
</script>

<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

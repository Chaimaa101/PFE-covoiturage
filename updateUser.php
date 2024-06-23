<?php
// Connect to your database (assuming connection.php contains your database connection logic)
require 'connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs if necessary
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $date_naissance = $_POST['date_naissance'];
    $role = $_POST['role'];
    $adresse = $_POST['adresse'];

    // Prepare update query
    $sql = "UPDATE utilisateurs SET nom='$nom', prenom='$prenom', email='$email', telephone='$telephone', date_naissance='$date_naissance', role='$role', adresse='$adresse' WHERE id='$id'";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "Enregistrement mis à jour avec succès";
        // Optionally redirect or perform additional actions after successful update
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<?php

include 'connection.php';
$conducteur_id = $_GET['conducteur_id'];


$sql = "SELECT Utilisateurs.nom, Voitures.marque, Voitures.modele, Voitures.annee, Voitures.couleur, Voitures.prix_km
        FROM Utilisateurs
        JOIN Voitures ON Utilisateurs.id = Voitures.conducteur_id
        JOIN Trajets_Conducteurs ON Utilisateurs.id = Trajets_Conducteurs.conducteur_id
        WHERE Utilisateurs.id = '$conducteur_id'
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p>Conducteur: " . $row['nom'] . "</p>";
    echo "<p>Voiture: " . $row['marque'] . " " . $row['modele'] . " (" . $row['annee'] . ") - " . $row['couleur'] . "</p>";
    echo "<p>Prix: " . $row['prix_km'] . " DH</p>";
} else {
    echo "Aucun détail trouvé pour ce conducteur.";
}

$conn->close();
?>

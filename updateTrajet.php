<?php
// Connect to your database (assuming connection.php contains your database connection logic)
require 'connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs if necessary
    $id = $_POST['id'];
    $depart = $_POST['depart'];
    $destination = $_POST['destination'];
    $date_depart = $_POST['date_depart'];
    $date_arrivee = $_POST['datae_arrivee'];
    $distance = $_POST['distance'];

    // Prepare update query
    $sql = "UPDATE trajets SET depart='$depart', destination='$destination', date_depart='$date_depart', date_arrivee='$date_arrivee', distance='$distance' WHERE id ='$id';";
    // Execute query
    if ($conn->query($sql)) {
        echo "Enregistrement mis à jour avec succès";
        // Optionally redirect or perform additional actions after successful update
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>

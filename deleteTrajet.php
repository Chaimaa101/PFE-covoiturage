<?php
require_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; 

    $stmt = $conn->prepare("DELETE FROM trajetss WHERE id = $id");

    if ($stmt->execute()) {
        echo'';
    } else {
        echo "Erreur: " . $stmt->error;
    }
} else {
    echo "ID non fourni";
}
?>

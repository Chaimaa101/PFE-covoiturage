<?php
require_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; 

    $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id = $id");

    if ($stmt->execute()) {
        header('Location: login.php?deleted=1');
    } else {
        echo "Erreur: " . $stmt->error;
    }
} else {
    echo "ID non fourni";
}
?>

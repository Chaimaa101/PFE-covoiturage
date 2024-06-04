<?php
include 'connection.php';
$id_trajet = $_POST['id_trajet'];
$id_conducteur = $_POST['id_conducteur'];

$note = $_POST['note'];
$commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';

$sql = "INSERT INTO Evaluations (id_trajet, id_conducteur, id_passager, note, commentaire) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiis", $id_trajet, $id_conducteur, $user_id, $note, $commentaire);

if ($stmt->execute()) {
    echo "Évaluation enregistrée avec succès.";
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
$conn->close();

header('Location: historiquetrajets.php');
exit();
?>

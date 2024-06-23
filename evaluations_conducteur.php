<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Evaluations des Passagers</title>
    <link rel="shortcut icon" href="img/logoblue.png" type="image/png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<?php

include 'connection.php';
require("header.php");

// Requête SQL pour récupérer les évaluations du conducteur
$sql = "
SELECT Evaluations.note, Evaluations.commentaire, Trajets.depart, Trajets.destination, Trajets.date_depart, Utilisateurs.nom AS passager_nom, Utilisateurs.prenom AS passager_prenom, Utilisateurs.moyenne_evaluation as moyenne
FROM Evaluations
LEFT JOIN Trajets ON Evaluations.id_trajet = Trajets.id
LEFT JOIN Utilisateurs ON Trajets.passager_id = Utilisateurs.id
WHERE Evaluations.id_conducteur = $user_id
ORDER BY Evaluations.id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
       <?php //echo "Moyenne d'évaluation: " . htmlspecialchars($row['moyenne']);  ?>
    </h1>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
   </div>
</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Evaluations des Passagers</h6>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
             <tr onclick="showModal(<?php echo $row['id']; ?>)">
          
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Date</th>
                <th>Passager</th>
                <th>Note</th>
                <th>Commentaire</th>
            </tr>
        </thead>
        <tbody>
        <?php
         if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            
                echo "<td>" . htmlspecialchars($row['depart']) . "</td>";
                echo "<td>" . htmlspecialchars($row['destination']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date_depart']) . "</td>";
                echo "<td>" . htmlspecialchars($row['passager_nom'] . " " . $row['passager_prenom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['note']) . "/5</td>";
                echo "<td>" . htmlspecialchars($row['commentaire']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Aucune évaluation trouvée.</td></tr>";
        }
        
$stmt->close();
$conn->close();

        
        ?>
                </thead>
                <tbody>
                      
             
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Details trajets</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<script>
function showModal(trajetId) {
    $.ajax({
        url: 'showModeltraject.php',
        type: 'GET',
        data: { id: trajetId },
        success: function(response) {
            $('#showModal .modal-body').html(response);
            $('#showModal').modal('show');
        }
    });
}
</script>
<!-- /.container-fluid -->
</body>

</html>














































<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TRAJETS REALISES</title>
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

$point_depart = isset($_GET['point_depart']) ? $_GET['point_depart'] : '';
$point_arrivee = isset($_GET['point_arrivee']) ? $_GET['point_arrivee'] : '';

$sql = "SELECT DISTINCT Trajets.*, Trajets_Conducteurs.valide 
        FROM Trajets
        LEFT JOIN Trajets_Conducteurs ON Trajets.id = Trajets_Conducteurs.trajet_id
        WHERE
        (Trajets.statut = 'validé' AND Trajets_Conducteurs.conducteur_id = $user_id AND Trajets_Conducteurs.valide = 1)";
        
        if ($point_depart) {
            $sql .= " AND Trajets.depart LIKE '%$point_depart%'";
        }

        if ($point_arrivee) {
            $sql .= " AND Trajets.destination LIKE '%$point_arrivee%'";
        }

    $sql .= " ORDER BY Trajets.date_depart DESC";       
$result = $conn->query($sql);
?>


 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <form method="get" action="trajetrealises.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0">
            <input type="text" class="form-control bg-light border-1" id="point_depart" placeholder="Départ" name="point_depart" value="<?php echo htmlspecialchars($point_depart); ?>">
            <input type="text" class="form-control bg-light border-1" id="point_arrivee" placeholder="Arrivée" name="point_arrivee" value="<?php echo htmlspecialchars($point_arrivee); ?>">

        <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-sm"></i></button>
    </form>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
   </div>
</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Les Trajets Réalisés</h6>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
          
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                    <tr>
                        <th>Depart</th>
                        <th>Destination</th>
                        <th>Date Depart</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                     <tr onclick="showModal(<?php echo $row['id']; ?>)">
                        <td><?php echo ($row['depart']) ?></td>
                        <td><?php echo ($row['destination']) ?></td>
                        <td><?php echo ($row['date_depart']) ?></td>
                    </tr>
                  <?php 
               
            
               
                } ?>         
             
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

<!-- /.container-fluid -->
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
</body>

</html>
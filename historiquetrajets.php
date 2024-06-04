<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TRAJETS</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php
        require("header.php");
?>

 <!-- Begin Page Content -->
 <div class="container-fluid">


<?php

include 'connection.php';
// sql to to display students
$sql = "SELECT * FROM trajets";

function getTrajetsUtilises($conn, $id_passager) {
    $sql = "SELECT trajets.*
            FROM trajets 
                        WHERE trajets.passager_id = $id_passager AND trajets.statut = 'valide'";
    $result = $conn->query($sql);
    $trajets = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $trajets[] = $row;
        }
    }
    return $trajets;
}

$trajetsUtilises = getTrajetsUtilises($conn, $user_id);

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Historique Des Trajets Réalisés</h6>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                    <tr>
                        <th>Depart</th>
                        <th>Destination</th>
                        <th>Date Depart</th>
                        <th></th>
                        
                       
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($trajetsUtilises as $trajet) { ?>
                    <tr>
                        <td><?= $trajet['depart'] ?></td>
                        <td><?php echo ($trajet['destination']) ?></td>
                        <td><?= $trajet['date_depart'] ?></td>
                        <td></td>
                    </tr>
                  <?php } ?>         
             
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

    


</body>

</html>
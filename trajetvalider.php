<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TRAJETS VALIDES</title>

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
        // Fonction pour récupérer les trajets choisi par le conducteur
    function getTrajetsPassagers($conn, $user_id) {
        $sql = "SELECT t.id, t.depart, t.destination, t.date_depart
            FROM trajets_conducteurs tc
            JOIN trajets t ON tc.trajet_id = t.id
            WHERE tc.conducteur_id = $user_id AND tc.valide = TRUE ";
    $result = $conn->query($sql);
        $trajets = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $trajets[] = $row;
            }
        }
        return $trajets;
    }

    $trajetsPassagers = getTrajetsPassagers($conn);
 
 
 ?>
<body>

 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Pa
ge Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
             <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Trajets Valider</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
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
                <?php foreach ($trajetsPassagers as $trajet)  { ?> 
                    <tr>
                        <td><?php echo ($trajet['depart']) ?></td>
                        <td><?php echo ($trajet['destination']) ?></td>
                        <td><?php echo ($trajet['date_depart']) ?></td>
                        
                    </tr>
                  <?php 
            
                
                } ?>         
             
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

    


</body>

</html>
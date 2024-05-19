<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TRAJETS ANNONCES</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php
        require("headerConducteur.php");
?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
             <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Trajets Annonces</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>
</div>

<?php

include 'connection.php';

        // Fonction pour récupérer les trajets proposés par les passagers
    function getTrajetsPassagers($conn) {
        $sql = "SELECT trajet.*, passager.nom, passager.prenom 
                FROM trajet 
                JOIN passager ON trajet.id_passager = passager.id_passager 
                WHERE trajet.statut = 'proposé'";
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
 
 

    // Fonction pour qu'un conducteur choisisse un trajet
    function choisirTrajet($conn, $id_cond, $id_trajet) {
        // Insérer dans trajets_conducteurs
        $sql = "INSERT INTO trajets_conducteurs (id_trajet, id_conducteur) VALUES ($id_trajet, $id_cond)";
        if ($conn->query($sql) === TRUE) {
            // Mettre à jour le statut du trajet
            $sql = "UPDATE trajet SET statut = 'choisi' WHERE id_trajet = $id_trajet";
            $conn->query($sql);
            echo "Trajet choisi avec succès.";
        } else {
            echo "Erreur: " . $conn->error;
        }
    }
 
 
 ?>



<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Les Trajets Annonces</h6>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                    <tr>
                        <th>Depart</th>
                        <th>Destination</th>
                        <th>Date Depart</th>
                        <th>Nom & Prenom </th>
                        <th>Choisir</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($trajetsPassagers as $trajet)  { ?> 
                    <tr>
                        <td><?php echo ($trajet['lieu_depart']) ?></td>
                        <td><?php echo ($trajet['lieu_darrivee']) ?></td>
                        <td><?php echo ($trajet['date_heure_depart']) ?></td>
                        <td><?php echo ($trajet['nom']. " " . $trajet['prenom']) ?></td>
                        <td><i class="bi bi-check2-square"></i><a href='trajetsannonces.php?id_trajet= <?php echo ($trajet['id_trajet'])?>&id_cond=1'>Choisir</a></td>
                    </tr>
                  <?php 
                if (isset($_GET['id_trajet']) && isset($_GET['id_cond'])) {
                    choisirTrajet($conn, $_GET['id_cond'], $_GET['id_trajet']);
                }
            
                $conn->close();
                
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
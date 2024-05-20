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

include 'connection.php';

require("header.php");

$sql = "SELECT t.id, t.depart, t.destination, t.date_depart, u.nom AS conducteur_nom
            FROM trajets_conducteurs tc
            JOIN trajets t ON tc.trajet_id = t.id
            JOIN utilisateurs u ON tc.conducteur_id = u.id
            WHERE t.passager_id = $user_id AND t.statut = 'choisi'";
    $result = $conn->query($sql);

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
    <h1 class="h3 mb-0 text-gray-800">Listes Des Trajets</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Trajets à Valider</h6>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                    <tr>
                        <th>Depart</th>
                        <th>Destination</th>
                        <th>Date Depart</th>
                        <th>Nom de Conducteur</th>
                        <th>Valider</th>
                        
                       
                    </tr>
                </thead>
                <tbody>
               <?php while ($row = $result->fetch_assoc()) { ?>  
                <tr>
                    <td><?php echo$row['depart']?></td>
                    <td><?php echo$row['destination']?></td>
                    <td><?php echo$row['date_depart']?></td>
                    <td><?php echo$row['conducteur_nom']?></td>
                    <td>
                        <form action='validertrajet.php' method='post'>
                            <input type='hidden' name='trip_id' value='<?php echo$row['id']?>'>
                            <input type='hidden' name='conducteur_id' value='<?php echo$row['conducteur_id']?>'>
                            <button type='submit'>Valider</button>
                        </form>
                    </td>
                  </tr>  
                    
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php

// Vérification des données du formulaire
if (isset($_POST['trip_id']) && isset($_POST['conducteur_id'])) {
    $trip_id = intval($_POST['trip_id']);
    $conducteur_id = intval($_POST['conducteur_id']);

    

    // Mise à jour du statut du trajet en 'validé'
    $sql = "UPDATE trajets SET statut = 'validé' WHERE id = $trip_id";
    if ($conn->query($sql) === TRUE) {
        echo "Le trajet a été validé avec succès.<br>";
    } else {
        echo "Erreur lors de la validation du trajet : " . $conn->error . "<br>";
    }

    // Mise à jour du statut dans la table trajets_conducteurs
    $sql = "UPDATE trajets_conducteurs SET valide = TRUE WHERE trajet_id = $trip_id AND conducteur_id = $conducteur_id";
    if ($conn->query($sql) === TRUE) {
        echo "Le conducteur a été notifié de la validation.<br>";
    } else {
        echo "Erreur lors de la mise à jour de la validation du conducteur : " . $conn->error . "<br>";
    }
} else {
    echo "Les données nécessaires n'ont pas été reçues.";
}

$conn->close();
?>


</div>
<!-- /.container-fluid -->

    


</body>

</html>
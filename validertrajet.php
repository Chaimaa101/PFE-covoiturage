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

$sql = "SELECT t.*, tc.choisi, tc.valide, tc.annuler, u.nom AS conducteur_nom , u.id as conducteur_id
            FROM trajets t 
            JOIN trajets_conducteurs tc ON  t.id = tc.trajet_id
            JOIN utilisateurs u ON tc.conducteur_id = u.id
            WHERE t.passager_id = $user_id AND tc.choisi = TRUE AND tc.valide = FALSE AND tc.annuler = FALSE AND t.statut != 'validé' ";
        $sql .= " ORDER BY t.date_depart DESC";
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
                        <th>Conducteur</th>
                        <th>Statut</th>
                        <th>Valider</th>
                        <th>Rejeter</th>
                        <th>Détails</th>
                       
                    </tr>
                </thead>
                <tbody>
               <?php while ($row = $result->fetch_assoc()) { ?>  
                <tr>
                    <td><?php echo$row['depart']?></td>
                    <td><?php echo$row['destination']?></td>
                    <td><?php echo$row['date_depart']?></td>
                    <td><?php echo$row['conducteur_nom']?></td>
                    <td><?php echo$row['statut']?></td>
                    <td>
                        <?php
                        if ($row['valide'] == 1) {
                            echo "Validé";
                        } else {
                            echo "<form method='post' action='validertrajet.php'>
                                <input type='hidden' name='id_trajet' value='" . $row['id'] . "'>
                                <input type='hidden' name='id_conducteur' value='" . $row['conducteur_id'] . "'>
                                <input type='hidden' name='action' value='valider'>
                                <input type='submit' value='Valider' class='btn btn-success'>
                            </form>";
                        }
                        echo "</td>";
                        echo "<td>";
                        if ($row['valide'] == 0) {
                            echo "<form method='post' action='validertrajet.php'>
                                <input type='hidden' name='id_trajet' value='" . $row['id'] . "'>
                                <input type='hidden' name='id_conducteur' value='" . $row['conducteur_id'] . "'>
                                <input type='hidden' name='action' value='rejeter'>
                                <input type='submit' value='Rejeter' class='btn btn-danger'>
                            </form>";
                        } else {
                            echo "Non validé";
                        }
                        echo "</td>";
                        echo "<td>";
                        echo "<button type='button' class='btn btn-info' data-toggle='modal' data-target='#detailsModal' data-conducteur_id='" . $row['conducteur_id'] . "'>Détails</button>";
                        ?>
                    </td>
                  </tr>  
                    
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Détails du Conducteur et de la Voiture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detailsContent">
                    <!-- Les informations seront chargées ici par AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclure les scripts de Bootstrap et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $('#detailsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Bouton qui a déclenché le modal
        var conducteur_id = button.data('conducteur_id'); // Extraire les infos des attributs data-*
        
        // Requête AJAX pour obtenir les détails
        $.ajax({
            url: 'details_conducteur.php',
            type: 'GET',
            data: { conducteur_id: conducteur_id },
            success: function(data) {
                $('#detailsContent').html(data); // Charger les données dans le modal
            }
        });
    });
    </script>




</div>
<!-- /.container-fluid -->
<?php

if (!isset($_POST['id_trajet']) || !isset($_POST['action'])) {
    echo "Paramètres manquants.";
    exit();
}

$id_trajet = $_POST['id_trajet'];
$action = $_POST['action'];
$conducteur_id = $_POST['id_conducteur'];

if ($action == 'valider') {
    // Mettre à jour la table Trajets_Conducteurs
    $sql = "UPDATE Trajets_Conducteurs SET valide = 1 , choisi = 0 WHERE trajet_id = $id_trajet AND conducteur_id = $conducteur_id";
    $conn->query($sql);

    // Mettre à jour la table Trajets
    $sql = "UPDATE Trajets SET statut = 'validé' WHERE id = $id_trajet";
    $conn->query($sql);
} elseif ($action == 'rejeter') {
    // Mettre à jour la table Trajets_Conducteurs
    $sql = "UPDATE Trajets_Conducteurs SET valide = 0 , choisi = 0 , annuler = 1 WHERE trajet_id = $id_trajet AND conducteur_id = $conducteur_id";
    $conn->query($sql);

}

$conn->close();
exit();
?>
</body>

</html>
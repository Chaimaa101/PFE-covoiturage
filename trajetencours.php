<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TRAJETS EN COURS</title>

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

// $sql = "SELECT t.*, u.nom AS conducteur_nom , u.id as conducteur_id , moyenne_evaluation
//             FROM trajets t 
//             JOIN trajets_conducteurs tc ON  t.id = tc.trajet_id
//             JOIN utilisateurs u ON tc.conducteur_id = u.id
//             WHERE t.passager_id = $user_id AND t.statut = 'proposé' ";
//         $sql .= " ORDER BY t.date_depart DESC";
//     $result = $conn->query($sql);

$sql = "SELECT t.id AS trajet_id,t.depart,t.destination,t.date_depart
        FROM Trajets t
        WHERE t.passager_id = $user_id AND t.statut = 'proposé'";
$result = $conn->query($sql);

?>

       
<!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Listes Des Trajets</h1>
  
</div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Trajets en cours</h6>
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
                       
                    </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                    // Récupérer les conducteurs intéressés par ce trajet
                    $trajet_id = $row['trajet_id'];
                    $sql_conducteurs = "SELECT u.nom, u.prenom, u.moyenne_evaluation,u.id,t.id as id_trajet
                                        FROM Trajets_Conducteurs tc
                                        JOIN Utilisateurs u ON tc.conducteur_id = u.id
                                        JOIN trajets t ON  t.id = tc.trajet_id
                                        WHERE tc.trajet_id = ? AND tc.choisi = 1
                                        GROUP BY u.id";
                    $stmt_conducteurs = $conn->prepare($sql_conducteurs);
                    $stmt_conducteurs->bind_param("i", $trajet_id);
                    $stmt_conducteurs->execute();
                    $result_conducteurs = $stmt_conducteurs->get_result();
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['depart']); ?></td>
                        <td><?php echo htmlspecialchars($row['destination']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_depart']); ?></td>
                        <td>
                            <table>
                                    <?php if ($result_conducteurs->num_rows > 0): ?>
                                        <?php while ($row_conducteur = $result_conducteurs->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row_conducteur['nom'] . ' ' . $row_conducteur['prenom']); ?></td>
                                                <td><?php echo htmlspecialchars(number_format($row_conducteur['moyenne_evaluation'], 1)); ?>/5</td>
                                                <td>
                                                <button type='button' class='btn btn-info' data-toggle='modal' data-target='#detailsModal' data-conducteur_id="<?php echo $row_conducteur['id']; ?>">Détails</button>
                                                </td>
                                                <td>
                        <?php
                            echo "<form method='post' action='trajetencours.php'>
                                <input type='hidden' name='id_trajet' value='" . $row_conducteur['id_trajet'] . "'>
                                <input type='hidden' name='id_conducteur' value='" . $row_conducteur['id'] . "'>
                                <input type='hidden' name='action' value='valider'>
                                <input type='submit' value='Valider' class='btn btn-success'>
                            </form>";
                        ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Aucun conducteur n'a encore choisi ce trajet.</td>
                                        </tr>
                                    <?php endif; ?>
                            </table>
                        </td>
                    </tr>
                    <?php
                    $stmt_conducteurs->close();
                    ?>
                <?php endwhile; ?>
            <?php else: ?>    
                        
                <tr>
                    <td colspan="5" class="text-center">Aucun trajet en cours trouvé.</td>
                </tr>
            <?php endif; ?>
               
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
    $sql = "UPDATE Trajets_Conducteurs SET choisi = 0, valide = 1 ,  annuler = 0 WHERE trajet_id = $id_trajet AND conducteur_id = $conducteur_id";
    $conn->query($sql);

    // Mettre à jour la table Trajets
    $sql1 = "UPDATE Trajets SET statut = 'validé' WHERE id = $id_trajet";
    $conn->query($sql1);
} 

$conn->close();
exit();
?>
</body>

</html>
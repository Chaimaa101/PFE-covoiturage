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

include 'connection.php';
require("header.php");

$point_depart = isset($_GET['point_depart']) ? $_GET['point_depart'] : '';
$point_arrivee = isset($_GET['point_arrivee']) ? $_GET['point_arrivee'] : '';
$statut = isset($_GET['statut']) ? $_GET['statut'] : '';

$sql = "SELECT DISTINCT Trajets.*, Trajets_Conducteurs.choisi, Trajets_Conducteurs.valide
        FROM Trajets
        LEFT JOIN Trajets_Conducteurs ON Trajets.id = Trajets_Conducteurs.trajet_id AND Trajets_Conducteurs.conducteur_id = $user_id
        WHERE
        (Trajets.statut = 'proposé'
        OR (Trajets_Conducteurs.conducteur_id = $user_id AND Trajets_Conducteurs.choisi = 1)
        OR (Trajets_Conducteurs.conducteur_id = $user_id AND Trajets_Conducteurs.choisi = 0)
        OR (Trajets_Conducteurs.conducteur_id = $user_id AND Trajets_Conducteurs.valide = 1))";
        
        if ($point_depart) {
            $sql .= " AND Trajets.depart LIKE '%$point_depart%'";
        }

        if ($point_arrivee) {
            $sql .= " AND Trajets.destination LIKE '%$point_arrivee%'";
        }

        
        if ($statut) {
            if ($statut == 'choisi') {
                $sql .= " AND Trajets_Conducteurs.choisi = 1 AND Trajets_Conducteurs.valide = 0 AND Trajets_Conducteurs.annuler = 0";
            } elseif ($statut == 'annulé') {
                $sql .= " AND Trajets_Conducteurs.choisi = 0 AND Trajets_Conducteurs.valide = 0 AND Trajets_Conducteurs.annuler = 1";
            } elseif ($statut == 'validé') {
                $sql .= " AND Trajets_Conducteurs.valide = 1 AND Trajets_Conducteurs.choisi = 0 AND Trajets_Conducteurs.annuler = 0";
            } else {
                $sql .= " AND Trajets.statut = '$statut'";
            }
        }
    $sql .= " ORDER BY Trajets.date_depart DESC";       
$result = $conn->query($sql);
?>


 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <form method="get" action="trajetsannonces.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0">
        <select class="form-control bg-light" name="statut">
                <option value="">Tous les trajets</option>
                    <option value="proposé" <?php if ($statut == 'proposé') echo 'selected'; ?>>Proposé</option>
                    <option value="choisi" <?php if ($statut == 'choisi') echo 'selected'; ?>>Choisi</option>
                    <option value="annulé" <?php if ($statut == 'annulé') echo 'selected'; ?>>Annulé</option>
                    <option value="validé" <?php if ($statut == 'validé') echo 'selected'; ?>>Validé</option>
        </select>
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
                        <th>Choisir</th>
                        <th>Annuler</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo ($row['depart']) ?></td>
                        <td><?php echo ($row['destination']) ?></td>
                        <td><?php echo ($row['date_depart']) ?></td>
                        <td>
                           <?php 
                           if ($row['choisi'] == 1) {
                            echo "Choisi";
                        } else {
                            echo "<form method='post' action='trajetsannonces.php'>
                                <input type='hidden' name='id_trajet' value='" . $row['id'] . "'>
                                <input type='hidden' name='action' value='choisir'>
                                <input type='submit' value='Choisir'>
                            </form>";
                        }
                        echo "</td>";
                        echo "<td>";
                        if ($row['choisi'] == 1) {
                            echo "<form method='post' action='trajetsannonces.php'>
                                <input type='hidden' name='id_trajet' value='" . $row['id'] . "'>
                                <input type='hidden' name='action' value='annuler'>
                                <input type='submit' value='Annuler'>
                            </form>";
                        } else {
                            echo "Non choisi";
                        }
                           ?> 
                           
                        </td>
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

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_trajet = $_POST['id_trajet'];
    $action = $_POST['action'];


    if ($action == 'choisir') {
        $sql = "INSERT INTO Trajets_Conducteurs (trajet_id, conducteur_id, choisi, valide) VALUES ('$id_trajet', '$user_id', TRUE, FALSE)
        ON DUPLICATE KEY UPDATE choisi=TRUE, valide=FALSE,annuler=FALSE";
    } elseif ($action == 'annuler') {
        $sql = "UPDATE Trajets_Conducteurs SET choisi=FALSE, valide=FALSE, annuler=TRUE WHERE trajet_id='$id_trajet' AND conducteur_id='$user_id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Action réussie";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    exit();
}
?>


</body>

</html>
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

    <style>
        .star-rating {
            direction: rtl;
            display: inline-block;
            padding: 20px;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            color: #bbb;
            font-size: 18px;
            padding: 0;
            cursor: pointer;
            display: inline-block;
        }
        .star-rating label:before {
            content: '\2605';
        }
        .star-rating input:checked ~ label {
            color: #f2b600;
        }
        .star-rating input:hover ~ label {
            color: #f2b600;
        }
        </style>
</head>

<?php
        require("header.php");

        
include 'connection.php';
$statut = isset($_GET['statut']) ? $_GET['statut'] : '';
$sql = "
SELECT
    Trajets.*,
    Utilisateurs.nom AS conducteur_nom,
    Trajets_Conducteurs.valide,
    Trajets_Conducteurs.choisi,
    Trajets_Conducteurs.annuler,
    Trajets_Conducteurs.conducteur_id,
    Evaluations.note,
    Evaluations.commentaire
FROM
    Trajets
LEFT JOIN
    Trajets_Conducteurs ON Trajets.id = Trajets_Conducteurs.trajet_id
LEFT JOIN
    Evaluations ON Trajets.id = Evaluations.id_trajet AND Trajets_Conducteurs.conducteur_id = Evaluations.id_conducteur
LEFT JOIN
    Utilisateurs ON Trajets_Conducteurs.conducteur_id = Utilisateurs.id
WHERE
    Trajets.passager_id = $user_id AND
    (Trajets.statut = 'proposé'
        OR (Trajets_Conducteurs.choisi = 1 AND Trajets_Conducteurs.valide = 0 AND Trajets_Conducteurs.annuler = 0)
        OR (Trajets_Conducteurs.choisi = 0 AND Trajets_Conducteurs.valide = 0 AND Trajets_Conducteurs.annuler = 1)
        OR (Trajets_Conducteurs.choisi = 0 AND Trajets_Conducteurs.valide = 1 AND Trajets_Conducteurs.annuler = 0))
";
if ($statut) {
    if ($statut == 'proposé') {
        $sql .= " AND Trajets.statut = '$statut'";
    } elseif ($statut == 'validé') {
        $sql .= " AND Trajets_Conducteurs.choisi = 0 AND Trajets_Conducteurs.valide = 1 AND Trajets_Conducteurs.annuler = 0";
    } elseif ($statut == 'choisi') {
        $sql .= " AND Trajets_Conducteurs.choisi = 1 AND Trajets_Conducteurs.valide = 0 AND Trajets_Conducteurs.annuler = 0";
    } elseif ($statut == 'annuler') {
        $sql .= " AND Trajets_Conducteurs.choisi = 0 AND Trajets_Conducteurs.valide = 0 AND Trajets_Conducteurs.annuler = 1";
    } 
}


// Ajouter la clause ORDER BY pour trier les trajets par date de départ en ordre décroissant
$sql .= " ORDER BY Trajets.date_depart DESC";

$result = $conn->query($sql);

?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <form method="get" action="historiquetrajets.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0">
        <select class="form-control bg-light" name="statut">
            <option value="">Tous</option>
                    <option value="proposé" <?php if ($statut == 'proposé') echo 'selected'; ?>>Proposé</option>
                    <option value="validé" <?php if ($statut == 'validé') echo 'selected'; ?>>Validé</option>
                    <option value="annuler" <?php if ($statut == 'annuler') echo 'selected'; ?>>Rejeter</option>
                    <option value="choisi" <?php if ($statut == 'choisi') echo 'selected'; ?>>Choisi</option>
        </select>
        <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-sm"></i></button>
    </form>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>
</div>


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
                        <th>Conducteur</th>
                        <th>Évaluation</th>
                        <th>Évaluer</th>
                        
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<td>" . $row['depart'] . "</td>";
                        echo "<td>" . $row['destination'] . "</td>";
                        echo "<td>" . $row['date_depart'] . "</td>";
                        echo "<td>" . $row['conducteur_nom'] . "</td>";
                        echo "<td>";
                        if (isset($row['note'])) {
                            echo "Note: " . $row['note'] . "/5<br>";
                            echo "Commentaire: " . $row['commentaire'];
                        } else {
                            echo "Pas encore évalué";
                        }
                        echo "</td>";
                        echo "<td>";
                        if ($row['valide'] == 1 && $row['statut'] == 'validé') {
                            echo "
                            <form method='post' action='historiquetrajets.php'>
                                <input type='hidden' name='id_trajet' value='" . $row['id'] . "'>
                                <input type='hidden' name='id_conducteur' value='" . $row['conducteur_id'] . "'>
                                <div class='star-rating'>
                                    <input id='star-5-" . $row['id'] . "' type='radio' name='note' value='5'>
                                    <label for='star-5-" . $row['id'] . "' title='5 stars'>5</label>
                                    <input id='star-4-" . $row['id'] . "' type='radio' name='note' value='4'>
                                    <label for='star-4-" . $row['id'] . "' title='4 stars'>4</label>
                                    <input id='star-3-" . $row['id'] . "' type='radio' name='note' value='3'>
                                    <label for='star-3-" . $row['id'] . "' title='3 stars'>3</label>
                                    <input id='star-2-" . $row['id'] . "' type='radio' name='note' value='2'>
                                    <label for='star-2-" . $row['id'] . "' title='2 stars'>2</label>
                                    <input id='star-1-" . $row['id'] . "' type='radio' name='note' value='1'>
                                    <label for='star-1-" . $row['id'] . "' title='1 star'>1</label>
                                </div>
                                <textarea name='commentaire' placeholder='Commentaire' class='form-control mb-2'></textarea>
                                <button type='submit' class='btn btn-primary'>Évaluer</button>
                            </form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Aucun trajet trouvé</td></tr>";
                }
                ?>
                     
             
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
if (isset($_POST['id_trajet'], $_POST['id_conducteur'], $_POST['note'])) {
    $id_trajet = $conn->real_escape_string($_POST['id_trajet']);
    $id_conducteur = $conn->real_escape_string($_POST['id_conducteur']);
    $note = $conn->real_escape_string($_POST['note']);
    $commentaire = $conn->real_escape_string($_POST['commentaire']);

$sql = "INSERT INTO Evaluations (id_trajet, id_conducteur, id_passager, note, commentaire) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiis", $id_trajet, $id_conducteur, $user_id, $note, $commentaire);

if ($stmt->execute()) {
    echo "Évaluation enregistrée avec succès.";
} else {
    echo "Erreur: " . $stmt->error;
}

$stmt->close();
}
$conn->close();


exit();
?>

</div>
<!-- /.container-fluid -->

    


</body>

</html>
<?php
include 'connection.php';


$attribut = $_GET['attribut'];
$search = $_GET['search'];


$attribute = $conn->real_escape_string($attribut);
$search = $conn->real_escape_string($search);

if(isset($attribut) && isset($search)){

$sql = "SELECT * FROM trajets WHERE $attribut LIKE '%$search%'";
}else{
$sql = "SELECT * FROM trajets ";

}$result = $conn->query($sql);
    


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Liste des trajets</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
<?php
        require("header.php");
?>
                    

                    <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listes Des trajets</h6>
                        </div>
                        <div class="card-body">
                                                        <form method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <label for="attribut">Filtrer par:</label>
                            <select class="form-control bg-light border-0 small" name="attribut" id="attribut" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                                <option value="depart">Départ</option>
                                <option value="destination">Déstination</option>
                                <option value="status">Status</option>
                                <option value="date-depart">Date de départ</option>
                                <option value="distance">Distance</option>
                                
                                </select>
                <div style="width: 10px;"></div>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="rechercher..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                    </form> 
                    <div style="height: 10PX;"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id trajet</th>
                                            <th>id passager</th>
                                            <th>Depart</th>
                                            <th>Destination</th>
                                            <th>Date de depart</th>
                                            <th>Date d'arrivée</th>
                                            <th>status</th>
                                            <th>Distance</th>
                                            <th>Temps</th>
                                            <th>Prix</th>
                                            <th> </th>
                                    </thead>
                                </tr><tbody>
                                    <?php while($row = mysqli_fetch_assoc($result)) { ?>  
                                    <tr>
                                    <td><?php echo ($row['id'])?></td>
                                    <td><?php echo ($row['passager_id'])?></td>
                                    <td><?php echo ($row['depat'])?></td>
                                    <td><?php echo ($row['destination'])?></td>
                                    <td><?php echo ($row['date_depart'])?></td>
                                    <td><?php echo ($row['date_arrivee'])?></td>
                                    <td><?php echo ($row['status'])?></td>
                                    <td><?php echo ($row['email'])?></td>
                                    <td><?php echo ($row['email'])?></td>
                                    <td><?php echo ($row['email'])?></td>
                                    <td><a href="profil.php"><i class="fa fa-eye" style='font-size:20px;color:bleu'></i><a></td>
<?php }?>
                                </table>
                            </div><td><?php echo ($row['email'])?></td><td><?php echo ($row['email'])?></td><td><?php echo ($row['email'])?></td><td><?php echo ($row['email'])?></td>
                        </div>
                    </div>
                </div>



</body>
</html>
<?php


if(isset($_POST['submit'])){
    $depart = $_POST['depart'];
    $destination = $_POST['destination'];
    $date_depart = $_POST['date_depart'];
    $statut = $_POST['statut'];
    $passager_id = $_POST['passager_id'];
    $prix = $_POST['prix'];
    $nbr_places = $_POST['nbr_places'];

        $host ='localhost';    
        $user ='root';
        $pass ='';
        $dbname='covoiturage_db';
        $conn = mysqli_connect($host,$user,$pass,$dbname);

        $sql = "INSERT INTO trajets(depart, destination, date_depart, statut, passager_id, prix, nbr_places) values('$depart', '$destination', '$date_depart', '$statut', '$passager_id', '$prix', '$nbr_places',)";
        

    
    






}






     ?>   


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

<body>

 <!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ajouter Un Trajet</h6>
    </div>
    <?php require('map.php');?>
    <div class="col-sm-12 col-xl-6">
                        <div class="rounded h-100 p-4">

                            <h4 class="mb-4">Ajouter un Trajet</h4>

                            <form action="#" method="post"> 
                                <div class="mb-3">
<<<<<<< HEAD
                                    <label for="depart" class="form-label">Départ du trajet</label>
                                    <input type="text" class="form-control" id="depart" name="depart" />
=======
                                    <label for="lieu_depart" class="form-label">Départ du trajet</label>
                                    <input type="text" class="form-control" id="lieu_depart" name="depart" />
>>>>>>> a1806e9460266
                                </div>
                                <div class="mb-3">
                                    <label for="lieu_darrivee" class="form-label">Fin du trajet</label>
                                    <input type="text" class="form-control" id="lieu_darrivee" name="destination">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="date_heure_depart" class="form-label">Heure et Date du depart</label>
<<<<<<< HEAD
                                    <input type="datetime-local" class="form-control" id="date_heure_depart" name="date_depart" />
=======
                                    <input type="datetime-local" class="form-control" id="date_depart" name="date_heure_depart" />
>>>>>>> a1806e94602664f5d5471c0620608450e93e9e01
                                </div>
                                
<<<<<<< HEAD
                                
                                <div class="mb-3">
                                    <label for="id_passager" class="form-label">id passager</label>
                                    <input type="text" class="form-control" id="id_passager" name="passager_id" />
</div>
                                    <div class="mb-3">
                                    <label for="prix" class="form-label"id>Prix</label>
                                    <input type="text" class="form-control" id="prix" name="prix" />
                                </div>

                                    <div class="mb-3">
                                    <label for="places" class="form-label"id>Places Disponibles</label>
                                    <input type="text" class="form-control" id="places" name="nbr_places" />
</div>
                                    
                                </div>
=======

>>>>>>> a1806e94602664f5d5471c0620608450e93e9e01
                                <input type="submit" name="submit" value="Envoyer">
                            </form>
                        </div>
        </div>
</div>


<!-- /.container-fluid -->

    

<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>
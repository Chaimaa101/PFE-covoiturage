<?php

if(isset($_POST['submit'])){
    $lieu_depart = $_POST['lieu_depart'];
    $lieu_darrivee = $_POST['lieu_darrivee'];
    $date_heure_depart = $_POST['date_heure_depart'];
    $statut = $_POST['statut'];
    $id_cond = $_POST['id_cond'];
    $id_passager = $_POST['id_passager'];

    $host ='localhost';    
    $user ='root';
    $pass ='';
    $dbname='covoiturage';
    $conn = mysqli_connect($host,$user,$pass,$dbname);
	$sql = "INSERT INTO trajet (lieu_depart, lieu_darrivee, date_heure_depart, statut, id_cond, id_passager) values('$lieu_depart', '$lieu_darrivee', '$date_heure_depart', '$statut', '$id_cond', '$id_passager')"; 
    

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
        require("headerAdmin.php");
?>
             


            
    
    
<body>


          
          

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
        <h6 class="m-0 font-weight-bold text-primary">Ajouter Un Trajet</h6>
    </div>
    <div class="col-sm-12 col-xl-6">
                        <div class="rounded h-100 p-4">
                            <h4 class="mb-4">Ajouter un Marché</h4>
                            <form action="#" method="post"> 
                                <div class="mb-3">
                                    <label for="lieu_depart" class="form-label">Départ du trajet</label>
                                    <input type="text" class="form-control" id="lieu_depart" name="lieu_depart" />
                                </div>
                                <div class="mb-3">
                                    <label for="lieu_darrivee" class="form-label">Fin du trajet</label>
                                    <input type="text" class="form-control" id="lieu_darrivee" name="lieu_darrivee">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="date_heure_depart" class="form-label">Heure et Date du depart</label>
                                    <input type="datetime-local" class="form-control" id="date_heure_depart" name="date_heure_depart" />
                                </div>
                                <div class="mb-3">
                                    <label for="email">statut</label>
                                 <div>
                              <br> <label for="Input4" class="radio-inline"><input type="radio" name="statut" id="Input4">proposé</label></br>
                              <br> <label for="Input5" class="radio-inline"><input type="radio" name="statut" id="Input5">choisi</label></br>
                              <br> <label for="Input6" class="radio-inline"><input type="radio" name="statut" id="Input6">validé</label></br>
 </div>
 </div>                        
                                
                               <div class="mb-3">
                                    <label for="id_cond" class="form-label"id>id conducteur</label>
                                    <input type="text" class="form-control" id="id_cond" name="id_cond" />
                                </div>

                                
                                <div class="mb-3">
                                    <label for="id_passager" class="form-label">id passager</label>
                                    <input type="text" class="form-control" id="id_passager" name="id_passager" />
                                    
                                </div>
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
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id trajet</th>
                                            <th>id utilisateur</th>
                                            <th>Departure</th>
                                            <th>Destination</th>
                                            <th>Prix</th>
                                            <th>Piaces disponibles</th>
                                            <th>Date</th>
                                            <th>Temps</th>
                                            <th>Modifier</th>
                                            <th>supprimer</th>
                                    </thead>
                                </tr><tbody>
                                    <?php while($row = mysqli_fetch_assoc($result)) { ?>  
                                    <tr>
                                       <td><?php echo ($row['id'])?></td>
                                       <td><?php echo ($row['passager_id'])?>
                                       </td><td><?php echo ($row['email'])?>
                                       </td><td><?php echo ($row['email'])?>
                                       </td><td><?php echo ($row['email'])?></td>
                                       <td><?php echo ($row['email'])?></td>
                                       <td><?php echo ($row['email'])?></td>
                                       <td><?php echo ($row['email'])?></td>
                                       <td><?php echo ($row['email'])?></td>
                                       <td><?php echo ($row['email'])?></td>
                                        <td><a href="#"><i class="fa fa-trash"></i></td>
<?php }?>
                                   
                                </table>
                            </div><td><?php echo ($row['email'])?></td><td><?php echo ($row['email'])?></td><td><?php echo ($row['email'])?></td><td><?php echo ($row['email'])?></td>
                        </div>
                    </div>
                          
                </div>



</body>
</html>
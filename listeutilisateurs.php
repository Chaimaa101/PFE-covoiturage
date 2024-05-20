
<?php 

include 'connection.php';

// sql to to display students
$sql = "SELECT * FROM utilisateurs ";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Listes Des Utilisateurs</title>

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
   
   <!-- End of Topbar -->
                 <div class="container-fluid">


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listes Des Utilisateurs</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>adresse</th>
                                            <th>Date de Naissance</th>
                                            <th>Date d'inscription</th>
                                            <th>role</th>
                                        </tr>
                                    </thead>
                                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                    <tbody>
                                       <tr>
                                            <td><?php echo ($row['nom'])?></td>
                                            <td><?php echo ($row['prenom'])?></td>
                                            <td><?php echo ($row['email'])?></td>
                                            <td><?php echo ($row['telephone'])?></td>
                                            <td><?php echo ($row['adresse'])?></td>
                                            <td><?php echo ($row['date_naissance'])?></td>
                                            <td><?php echo ($row['date_inscription'])?></td>
                                            <td><a href="infocond.html"><i class="fa fa-eye" style='font-size:28px;color:bleu'></i><a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                
               
        <!-- End of Content Wrapper -->

                    <!-- INFO Modal-->
    <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">INFORMATION PERSONNEL</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table>
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td> Nom</td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td> Prenom</td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td> Email</td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </table>



                </div>
                
                
            </div>
        </div>
    </div>
   
    <!---->










    </body> 
    </html>     

<?php
include 'connection.php';
if(isset($_GET['search']) && isset($_GET['attribut'])){
$attribut = $_GET['attribut'];
$search = $_GET['search'];

$sql = "SELECT * FROM utilisateurs WHERE $attribut LIKE '%$search%' AND role = administrateur ORDER BY date_inscription";
}else{
$sql = "SELECT * FROM utilisateurs WHERE role = 'administrateur' ORDER BY date_inscription";

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
                            
                            <form method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <label for="">Filtrer par:</label>
                            <select class="form-control bg-light border-0 small" name="attribut" 
                                aria-label="Search" aria-describedby="basic-addon2">
                                <option value="nom">Nom</option>
                                <option value="email">Email</option>
                                <option value="telephone">Téléphone</option>
                                <option value="date_naissance">Date de naissance</option>
                                <option value="role">Rôle</option>
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
                        <div style="height: 10px;"></div>
                         <a href="ajouterUser.php" class="btn btn-primary">Ajouter un admin</a>
                    </form> 
                
                    <div style="height: 10PX;"></div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom et prenom</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>adresse</th>
                                            <th>Date de Naissance</th>
                                            <th>Date d'inscription</th>
                                            <th>role</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                                    <tbody>
                                    <tr>
                                            <td><?php echo ($row['nom'])." ".($row['prenom'])?></td>
                                            <td><?php echo ($row['email'])?></td>
                                            <td><?php echo ($row['telephone'])?></td>
                                            <td><?php echo ($row['adresse'])?></td>
                                            <td><?php echo ($row['date_naissance'])?></td>
                                            <td><?php echo ($row['date_inscription'])?></td>
                                            <td><?php echo ($row['role'])?></td>
                                            <td><button class="btn btn-primary" onclick="showModal(<?php echo ($row['id']); ?>)">Voir</button></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Informations Personnels</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
   
                </div>
                
                
            </div>
        </div>
    </div>
                </div>
                <script>
                    function showModal(userId) {
    // Effectuer une requête AJAX pour obtenir les informations de l'utilisateur
    $.ajax({
        url: 'showModeUser.php', // Un fichier PHP pour obtenir les infos de l'utilisateur
        type: 'GET',
        data: { id: userId },
        success: function(response) {
            // Charger la réponse dans le corps du modal
            $('#showModal .modal-body').html(response);
            // Afficher le modal
            $('#showModal').modal('show');
        }
    });
}
                </script>
    </body> 
    </html>     

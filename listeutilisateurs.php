<?php
 require ("connection.php");
 require("header.php");
$attribute = '';
$search = '';

$attribute = isset($_GET['attribute']) ? $_GET['attribute'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$attribute = $conn->real_escape_string($attribute);
$search = $conn->real_escape_string($search);

$sql = "SELECT * FROM utilisateurs";
if ($attribute && $search) {
    $sql .= " WHERE $attribute LIKE '%$search%'";
}

 
$result = $conn->query($sql);

if (!$result) {
    echo "Erreur: " . $conn->error;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Listes Des Utilisateurs</title>
    <link rel="shortcut icon" href="img/logoblue.png" type="image/png">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listes Des Utilisateurs</h6>
        </div>
        <div class="card-body">
            <form method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <label for="attribut">Filtrer par:</label>
                    <select class="form-control bg-light border-0 small" name="attribut" aria-label="Search" aria-describedby="basic-addon2">
                        <option value="nom" <?php if($attribute == 'nom') echo 'selected'; ?>>Nom</option>
                        <option value="email" <?php if($attribute == 'email') echo 'selected'; ?>>Email</option>
                        <option value="telephone" <?php if($attribute == 'telephone') echo 'selected'; ?>>Téléphone</option>
                        <option value="date_naissance" <?php if($attribute == 'date_naissance') echo 'selected'; ?>>Date de naissance</option>
                        <option value="role" <?php if($attribute == 'role') echo 'selected'; ?>>Rôle</option>
                    </select>
                    <div style="width: 10px;"></div>
                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="rechercher..." aria-label="Search" aria-describedby="basic-addon2" value="<?php echo htmlspecialchars($search); ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div style="height: 10px;"></div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom et prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Date de Naissance</th>
                            <th>Date d'inscription</th>
                            <th>Rôle</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                        <?php if($result) { 
                            while($row = $result->fetch_assoc()) { ?>
                       <tr onclick="showModal(<?php echo $row['id']; ?>)">
                            <td><?php echo htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                            <td><?php echo htmlspecialchars($row['adresse']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_naissance']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_inscription']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                        </tr>
                        <?php }} else { ?>
                        <tr>
                            <td colspan="7">Aucun utilisateur trouvé</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Informations Personnelles</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
</div>

<script>
function showModal(userId) {
    $.ajax({
        url: 'showModeUser.php',
        type: 'GET',
        data: { id: userId },
        success: function(response) {
            $('#showModal .modal-body').html(response);
            $('#showModal').modal('show');
        }
    });
}
</script>
</body>
</html>

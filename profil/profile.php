<?php
require_once '../connection.php';
if(isset($_GET['id']) ){
$id = $_GET['id'];

$sql = "SELECT * FROM utilisateurs WHERE id= $id";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
</head>
<body>

	

		<div class="row col-lg-8 border rounded mx-auto mt-5 p-2 shadow-lg">
			<div class="col-md-4 text-center">
				
				<div>

					

						<a href="profile-edit.php">
							<button class="mx-auto m-1 btn-sm btn btn-primary">Modifier</button>
						</a>
						<a href="profile-delete.php">
							<button class="mx-auto m-1 btn-sm btn btn-warning text-white">Supprimer</button>
						
				</div>
			</div>
			<?php 
            while($row = mysqli_fetch_assoc($result)) { ?>
			<div class="col-8">
				<div class="h2">Profile de l'utilisateur</div>
				<table class="table table-striped">
					<tr><th colspan="2"> Détail de  l'utilisateur :</th></tr>
					<tr><th><i class="bi bi-envelope"></i> Email</td></tr>
					<tr><th><i class="bi bi-person-circle"></i> PRENOM</td></tr>
					<tr><th><i class="bi bi-person-square"></i> NOM </td></tr>
					<tr><th><i class="bi bi-calendar-date"></i> DATE DE NAISSANCE </td></tr>
                    <tr><th><i class="bi bi-geo-alt-fill"></i> ADRESSE </td></tr>
                    <tr>
					<td><?php echo ($row['nom'])." ".($row['prenom'])?></td>
                                            <td><?php echo ($row['email'])?></td>
                                            <td><?php echo ($row['telephone'])?></td>
                                            <td><?php echo ($row['adresse'])?></td>
                                            <td><?php echo ($row['date_naissance'])?></td>
                                            
					</tr>
				</table>
				<?php }
                                            echo "Aucun utilisateur trouvé";
                                    ?>
			</div>
		</div>
	

</body>
</html>
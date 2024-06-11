

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-icons.css">
</head>
<body>

	
	
					<div class="mb-3">
					  <label for="formFile" class="form-label">Click below to select an image</label>
					  <input class="form-control" type="file" id="formFile">
				</div>
			</div>
			<div class="col-md-8">
				
				<div class="h2">modifier le  Profile</div>

				<form method="post" onsubmit="myaction.collect_data(event, 'profile-edit')">
					<table class="table table-striped">
						<tr><th colspan="2">Détails de l'utilisateur:</th></tr>
						<tr><th><i class="bi bi-envelope"></i> Email</th>
							<td>
								<input  type="text" class="form-control" name="email" placeholder="Email">
								
							</td>
						</tr>
						<tr><th><i class="bi bi-person-circle"></i> Nom</th>
							<td>
								<input  type="text" class="form-control" name="firstname" placeholder="First name">
							
							</td>
						</tr>
						<tr><th><i class="bi bi-person-square"></i> Prenom</th>
							<td>
								<input  type="text" class="form-control" name="lastname" placeholder="Last name">
							
							</td>
						</tr>
                        <tr><th><i class="bi bi-person-square"></i> adresse</th>
							<td>
								<input  type="text" class="form-control" name="lastname" placeholder="Last name">
							
							</td>
						</tr>

                        <tr><th><i class="bi bi-person-square"></i> date de naissancze</th>
							<td>
								<input  type="text" class="form-control" name="lastname" placeholder="Last name">
							
							</td>
						</tr>
						

					</table>

					

					<div class="p-2">
						
						<button class="btn btn-primary float-end">enrigistrer</button>
						
						<a href="profile.php">
							<label class="btn btn-secondary">retourner</label>
						</a>

					</div>
				</form>

			</div>
		</div>

	
</body>
</html>


				
<?php
include 'connection.php';

// Fetch the total number of users
$userCountSql = "SELECT COUNT(*) as total_users FROM utilisateurs";
$userCountResult = $conn->query($userCountSql);
$userCount = 0;
if ($userCountResult && $userCountRow = $userCountResult->fetch_assoc()) {
    $userCount = $userCountRow['total_users'];
}

// Fetch the total number of trips (trajets)
$trajetCountSql = "SELECT COUNT(*) as total_trajets FROM trajets";
$trajetCountResult = $conn->query($trajetCountSql);
$trajetCount = 0;
if ($trajetCountResult && $trajetCountRow = $trajetCountResult->fetch_assoc()) {
    $trajetCount = $trajetCountRow['total_trajets'];
}
    $vehiculeCountSql = "SELECT COUNT(*) as total_vehicule FROM voitures";
$vehiculeCountResult = $conn->query($vehiculeCountSql);
$vehiculeCount = 0;
if ($vehiculeCountResult && $vehiculeCountRow = $vehiculeCountResult->fetch_assoc()) {
    $vehiculeCount = $vehiculeCountRow['total_vehicule'];
}
$commCountSql = "SELECT COUNT(*) as total_comm FROM evaluations";
$commCountResult = $conn->query($commCountSql);
$vehiculeCount = 0;
if ($commCountResult && $commCountRow = $commCountResult->fetch_assoc()) {
    $commCount = $commCountRow['total_comm'];
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

    <title>Administrateur</title>
    <link rel="shortcut icon" href="img/logoblue.png" type="image/png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>

<?php require("header.php"); ?>

<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panneau d'Administration</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Users Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Utilisateurs</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $userCount; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trips Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            trajets</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $trajetCount; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Evaluations</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $commCount; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-star fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Véhicules
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $vehiculeCount; ?></div>
                            </div>
                            <div class="col">
                                <!-- Placeholder for a progress bar, if needed -->
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


</body>

</html>


<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['user_id']) && isset($_COOKIE['id'])) {
    $_SESSION['user_id'] = $_COOKIE['id'];
    $_SESSION['user_role'] = $_COOKIE['user_role'];
    $_SESSION['nom'] = $_COOKIE['nom'];
    $_SESSION['prenom'] = $_COOKIE['prenom'];
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit;
}

// Récupérer les informations de l'utilisateur connecté
$user_id = $_SESSION['user_id'];
$user_nom = $_SESSION['nom'];
$user_role = $_SESSION['user_role'];

$sql = "SELECT * FROM notification WHERE user_id = '$user_id' AND is_read = FALSE ORDER BY created_at DESC";
$result = $conn->query($sql);

$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
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
    <link rel="shortcut icon" href="img/logoblue.png" type="image/png">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-car"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CovoitFacile</div>
            </a>
            <?php if($user_role == 'administrateur'){ ?>
                

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item active ">
                <a class="nav-link" href="listeutilisateurs.php">
                    <i class="fa fa-users"></i>
                    <span>Gestion utilisateurs</span></a>
            </li>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="listetrajets.php">
                   <i class="fas fa-road"></i>
                    <span>Gestion Trajets</span></a>
            </li>
             <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="listeadmins.php">
                    <i class="fa fa-users"></i>
                    <span>Gestion Admins</span></a>
            </li>

            <hr class="sidebar-divider my-0">
<?php  }elseif($user_role == 'conducteur'){ ?>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="trajetsannonces.php">
                   <i class="fa fa-road"></i>
                    <span>Les annonces</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="trajetrealises.php">
                   <i class="fa fa-road"></i>
                    <span>Trajets réalisés</span></a>
            </li>

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="evaluations_conducteur.php">
                   <i class="fa fa-road"></i>
                    <span>Mes Evaluations</span></a>
            </li>

            <hr class="sidebar-divider my-0">

            
            <hr class="sidebar-divider my-0">     
<?php  }elseif($user_role == 'passager'){ ?>
<!-- Divider -->
            <hr class="sidebar-divider my-0">

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="ajoutertrajet.php">
                    <i class="fa fa-road"></i>
                    <span>Ajout trajets</span></a>
            </li>

            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="trajetencours.php">
                    <i class="fa fa-road"></i>
                    <span>Trajets en cours</span></a>
            </li>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="historiquetrajets.php">
                   <i class="fa fa-road"></i>
                    <span>Trajets réalisés</span></a>
            </li>

            <hr class="sidebar-divider my-0">

<?php  }?><!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

             <!-- Sidebar Toggle (Topbar) -->
             <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
             </button>

        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
<!-- Nav Item - Alerts -->
                    
                            <!-- Dropdown - Alerts -->
    <!-- Notification Dropdown -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter" id="notif-count">0</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown" id="notif-dropdown">
            <h6 class="dropdown-header">
                Centre d'Alertes
            </h6>
            <!-- Notifications will be dynamically inserted here -->
            <div id="notif-items"></div>
            <a class="dropdown-item text-center small text-gray-500" href="#" onclick="showAllNotifications()">Afficher Toutes Les Alertes</a>
        </div>
    </li>              
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo  htmlspecialchars($user_nom) ;?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profilModal">              
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login/logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Les informations personnelles</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><form action="" method="POST">
 <table>
    <?php
        require'connection.php';
            $sql = "SELECT * FROM utilisateurs where id = '$user_id' ";
            $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            ?>  
             <tr>
            <th>Id</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['id'];?>" name="id" readonly/></td>
            </tr>
            <tr>
            <th>Nom</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['nom'];?>" name="nom" /></td>
            </tr>
            <tr>
            <th>Prenom</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['prenom'];?>" name="prenom"/></td>
            </tr>
            <tr>
            <th>Email</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['email'];?>" name="email"/></td>
            </tr>
            <tr>
            <th>Téléphone</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['telephone'];?>" name="telephone"/></td>
            </tr>
            <tr>
            <th>Date de naissance</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['date_naissance'];?>" name="date_naissance"/></td>
            </tr>
            <tr>
            <th>Role</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['role'];?>" name="role"/></td>
            </tr>
            <tr>
            <th>Adresse</th>
            <td> <input type="text" class="form-control" value="<?php echo $row['adresse'];?>" name="adresse"/></td>
            </tr>
            <?php } else { echo "Aucun utilisateur trouvé"; }?>
</table>
</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" onclick="updateUser(<?php echo ($row['id']); ?>)">Modiffier infos</a>
                    <a class="btn btn-primary red" onclick="DeleteUser(<?php echo ($row['id']); ?>)">Supprimer compte </a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

        <script>

// Function to confirm deletion and then trigger AJAX call to deleteuser.php
function DeleteUser(userId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ?")) {
        // AJAX call to deleteuser.php
        $.ajax({
            type: "POST",
            url: "deleteUser.php",
            data: { id: userId },
            success: function(response) {
                // Handle success response if needed
                console.log(response);
                // Optionally, reload the page or handle UI update
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    }
}

// Function to update user info and trigger AJAX call to updateUser.php
function updateUser(userId) {
     if (confirm("Êtes-vous sûr de vouloir modifier votre compte ?")) {
    // AJAX call to updateUser.php
    $.ajax({
        type: "POST",
        url: "updateUser.php",
        data: { id: userId },
        success: function(response) {
            // Handle success response if needed
            console.log(response);
            // Optionally, reload the page or handle UI update
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(xhr.responseText);
        }
     });
    }   
}

    function fetchNotifications() {
            $.ajax({
                url: 'get_notifications.php',
                method: 'GET',
                success: function(response) {
                    let notifications = JSON.parse(response);
                    let notifCount = notifications.length;
                    $('#notif-count').text(notifCount > 0 ? notifCount : '0');
                    
                    let notifItems = $('#notif-items');
                    notifItems.empty(); // Clear previous notifications

                    if (notifCount > 0) {
                        notifications.forEach(function(notification) {
                            let notifHtml = `
                                <a class="dropdown-item d-flex align-items-center" href="trajetencours.php">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">${new Date(notification.created_at).toLocaleDateString()}</div>
                                        <span class="font-weight-bold">${notification.message}</span>
                                    </div>
                                </a>`;
                            notifItems.append(notifHtml);
                        });

                        // Optionally mark notifications as read
                        markNotificationsAsRead(notifications.map(n => n.id));
                    } else {
                        notifItems.append('<div class="dropdown-item text-center small text-gray-500">Pas de nouvelles notifications < / div>');
                    }
                }
            });
        }

        function markNotificationsAsRead(ids) {
            $.ajax({
                url: 'mark_notifications_as_read.php',
                method: 'POST',
                data: { ids: ids },
                success: function(response) {
                    console.log("Notifications marked as read");
                }
            });
        }

        // Fetch notifications every 30 seconds
        setInterval(fetchNotifications, 30000);

        // Fetch notifications on page load
        fetchNotifications();
        function showAllNotifications() {
    $.ajax({
        url: 'get_all_notifications.php', // Update the URL to your backend script
        method: 'GET',
        success: function(response) {
            let notifications = JSON.parse(response);
            let notifItems = $('#notif-items');
            notifItems.empty(); // Clear previous notifications

            if (notifications.length > 0) {
                notifications.forEach(function(notification) {
                    let notifHtml = `
                        <a class="dropdown-item d-flex align-items-center" href="trajetencours.php">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">${new Date(notification.created_at).toLocaleDateString()}</div>
                                <span class="font-weight-bold">${notification.message}</span>
                            </div>
                        </a>`;
                    notifItems.append(notifHtml);
                });

                // Optionally mark notifications as read
                markNotificationsAsRead(notifications.map(n => n.id));
            } else {
                notifItems.append('<div class="dropdown-item text-center small text-gray-500">Pas de nouvelles notifications');
            }
        }
    });
}
</script>

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
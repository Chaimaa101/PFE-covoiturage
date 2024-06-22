
<?php 
require('connection.php');
require("header.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    if(isset($_POST['depart'])&& isset($_POST['destination'])){
    $depart = $_POST['depart'];
    $destination = $_POST['destination'];
    $date_depart = $_POST['date_depart'];
    $date_arrivee = $_POST['date_arrivee'];
    $distance = $_POST['distance'];
    $passager_id = $user_id;
    $statut = 'proposé';
    $prix =$_POST['prix'];

     $stmt = $conn->prepare("INSERT INTO trajets (depart, destination, date_depart,date_arrivee,distance, statut, passager_id,prix) VALUES (?, ?, ?, ?,?, ?, ?,?)");
       $stmt->bind_param("ssssssss",$depart, $destination, $date_depart,$date_arrivee,$distance,$statut,$passager_id,$prix);
     if ($stmt === false) {
        die("Erreur de préparation de la requête: " . $conn->error);
    }
    }

    if ($stmt->execute()) {
        $_SESSION['alert'] = "Trajet ajouté avec succès.";
    echo "<p style='color:green;'>Trajet a été ajouté avec succès.</p>";
    } else {
        echo "Erreur: " . $stmt->error;
    } 

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajouter trajet</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            height: 80vh;
        }
        #controls {
            padding: 10px;
        }
        .col{
            margin-bottom: 20px;
        }
        
    </style>
</head>
<body>
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 "> <div id="map"></div></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Ajouter trajet</h1>
                            </div>
<form method="POST">
  <div class="row">
    <div class="col">
      <label for="startAddress" class="form-label">Départ du trajet</label>
    <input type="text" class="form-control" id="startAddress" name="depart" />
    </div>
    <div class="col">
       <label for="endAddress" class="form-label">Destinationt</label>
    <input type="text" class="form-control" id="endAddress" name="destination">                           
    </div>
</div>
    <div class="row">   
    <div class="col">
       <label for="date_depart" class="form-label">Heure et Date du depart</label>
    <input type="datetime-local" class="form-control" id="date_depart" name="date_depart" />
 </div>
    <div class="col">
        <label for="date_arrivee" class="form-label">Heure et Date d'arrivée</label>
        <input type="datetime-local" class="form-control" id="date_arrivee" name="date_arrivee" />
        </div>

    </div> <div style="height: 10px;"></div>
        <input type="button" value="Chercher" class="btn btn-primary" onclick="geocodeAddresses()" data-toggle="modal" data-target="#trajetModal">                              
  </div>
  <div class="modal fade" id="trajetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Details trajet</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
        <div class="mb-3">
                                    <label for="distance" class="form-label">Distance en (Km)</label>
                                    <input type="text" class="form-control" id="distance" name="distance" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="cost" class="form-label">Coût en (Dh)</label>
                                    <input type="text" class="form-control" id="cost" name="prix" readonly/>
                                </div>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" name="submit" value="Ajouter trajet">

</form>   
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
 
    </div>
   <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>
    <script src="https://unpkg.com/leaflet.locatecontrol/dist/L.Control.Locate.min.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="js/map.js"></script>
</body>
</html>


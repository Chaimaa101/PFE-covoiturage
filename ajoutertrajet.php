
<?php 
require('connection.php');
 require("header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $depart = $_POST['startAddress'];
    $destination = $_POST['endAddress'];
    $date_depart = $_POST['date_depart'];
    $date_arrivee = $_POST['date_arrivee'];
    $passager_id = $user_id;
    $statut = 'proposé';

    $sql = "INSERT INTO trajets (depart, destination, date_depart,date_arrivee, statut, passager_id) VALUES ('$depart', '$destination', '$date_depart','$date_arrivee', '$statut', '$passager_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Trajet ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Leaflet Routing Machine with Turf.js and Address Input</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            height: 80vh;
        }
        #controls {
            padding: 10px;
        }
    </style>
</head>
<body>
<!-- Begin Page Content -->
 <div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
     <div id="map"></div>
    <div class="col-sm-12 col-xl-6">
                        <div class="rounded h-100 p-4">

                            <h4 class="mb-4">Ajouter un Trajet</h4>
                            <form action="#" id="routeForm" method="post"> 
                                <div class="mb-3">
                                    <label for="startAddress" class="form-label">Départ du trajet</label>
                                    <input type="text" class="form-control" id="startAddress" name="depart" />
                                </div>
                                <div class="mb-3">
                                    <label for="endAddress" class="form-label">Destinationt</label>
                                    <input type="text" class="form-control" id="endAddress" name="destination">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="date_depart" class="form-label">Heure et Date du depart</label>
                                    <input type="datetime-local" class="form-control" id="date_depart" name="date_depart" />
                                </div>
                                <div class="mb-3">
                                    <label for="date_arrivee" class="form-label">Heure et Date d'arrivée</label>
                                    <input type="datetime-local" class="form-control" id="date_arrivee" name="date_arrivee" />
                                </div>
                                <div class="mb-3">
                                    <label for="distance" class="form-label">Distance en (Km)</label>
                                    <input type="text" class="form-control" id="distance" name="distance" />
                                </div>
                                

                                <input type="submit" name="submit"  value="Envoyer" onclick="geocodeAddresses()">
                            </form>
                        </div>
        </div>
</div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="js/map.js"></script>
</body>
</html>

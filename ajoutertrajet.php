
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
  <form action="" id="routeForm" method="POST">
      <div id="controls">
        <input type="text" id="startAddress" name="startAddress" placeholder="Enter start address" /> <br>
        <input type="text" id="endAddress" name="endAddress" placeholder="Enter end address" /><br>
        <input type="date" name="date_depart"><br>
        <input type="date" name="date_arrivee"><br>
        <input type="text" name="distance" id="distance">
        <button onclick="geocodeAddresses()">Find Route</button>
    </div>
  </form>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="js/map.js"></script>
</body>
</html>

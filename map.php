<!DOCTYPE html>
<html>
<head>
    <title>Carte avec Trajets et Marqueurs</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="css/leaflet-measure.css">
   
    <style>
        #map {
            height: 400px;
            width: 50%;
        }
    </style>
</head>
<body>
    <?php require("headerUtilisateur.php");?>
    <div class="container-fluid">

<h1>page Recherche trajet </h1>  
  
    <div id="map"></div>
    <form id="routeForm">
        <label for="startLat">Latitude de départ :</label>
        <input type="text" id="startLat" name="startLat" required>
        <label for="startLng">Longitude de départ :</label>
        <input type="text" id="startLng" name="startLng" required>
        <label for="endLat">Latitude d'arrivée :</label>
        <input type="text" id="endLat" name="endLat" required>
        <label for="endLng">Longitude d'arrivée :</label>
        <input type="text" id="endLng" name="endLng" required>
        <button type="submit">Ajouter Trajet</button>
    </form>

</div>
             <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> 
    <script src="js/leaflet-measure.js"></script>
    <script>
        
        // Initialisation de la carte
        var map = L.map('map').setView([31.792305849269, -7.080168000000015],11); 

        // Ajout de la couche de tuiles OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
//   //get user location
//         function getUserLocation() {
//         if (navigator.geolocation) {
//             navigator.geolocation.getCurrentPosition(position => {
//                 var lat = position.coords.latitude;
//                 var lon = position.coords.longitude;

//                 // Centrer la carte sur la position de l'utilisateur
//                 map.setView([lat, lon], 13);

//                 // Ajouter un marqueur à la position de l'utilisateur
//                 var marker = L.marker([lat, lon]).addTo(map)
//                     .bindPopup("Vous êtes ici").openPopup();

//                 // Utiliser le géocodage inverse pour obtenir l'adresse
//                 reverseGeocode(lat, lon);
//             }, showError);
//         } else {
//             alert("La géolocalisation n'est pas supportée par ce navigateur.");
//         }
//     }

//     // Fonction pour gérer les erreurs de géolocalisation
//     function showError(error) {
//         switch(error.code) {
//             case error.PERMISSION_DENIED:
//                 alert("L'utilisateur a refusé la demande de géolocalisation.");
//                 break;
//             case error.POSITION_UNAVAILABLE:
//                 alert("Les informations de localisation sont indisponibles.");
//                 break;
//             case error.TIMEOUT:
//                 alert("La demande de géolocalisation a expiré.");
//                 break;
//             case error.UNKNOWN_ERROR:
//                 alert("Une erreur inconnue est survenue.");
//                 break;
//         }
//     }
        
         // Function to perform geocoding using Nominatim
    function geocode(address) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    var lat = data[0].lat;
                    var lon = data[0].lon;

                    // Set the map view to the coordinates
                    map.setView([lat, lon], 13);

                    // Add a marker to the map at the coordinates
                    L.marker([lat, lon]).addTo(map)
                        .bindPopup(address)
                        .openPopup();
                } else {
                    alert('Address not found');
                }
            })
            .catch(error => console.error('Error:', error));
    }
    var address = 'CASABLANCA';
    geocode(address);

map.on('click',function(e){
    console.log(e);
        var secondMarker = L.marker([e.latLng.lat,e.latLng.lng]).addTo(map);
L.Routing.control({
  waypoints: [
    L.latLng(34.689404,  -1.912823),
    L.latLng( e.latLng.lat,e.latLng.lng)
  ]
}).addTo(map);
})
L.control.measure({
    primaryAreaUnit: 'kilometrs',
    secondaryAreaUnit: 'metrs',
    primaryAreaUnit: 'kilometrs',
    secondaryAreaUnit: 'metrs',
   
   
}).addTo(map) 
    </script>

</body>
</html>

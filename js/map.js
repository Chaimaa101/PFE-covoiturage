 // Initialize the map
        var map = L.map('map').setView([31.794525 ,-7.0849336],6); // Centered on London

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var geocoder = L.Control.Geocoder.nominatim();
        var startPoint, endPoint;
        var startMarker, endMarker;

        var routingControl = L.Routing.control({
            waypoints: [],
            routeWhileDragging: true,
            geocoder: geocoder,
            createMarker: function(i, waypoint, n) {
                var marker = L.marker(waypoint.latLng, {
                    draggable: true
                }).bindPopup(i === 0 ? "Start Point" : "End Point");
                return marker;
            },
            show: false
        }).addTo(map);

        // Add geocoding control
        L.Control.geocoder({
            defaultMarkGeocode: false
        }).on('markgeocode', function(e) {
            var latlng = e.geocode.center;
            if (!startPoint) {
                startPoint = latlng;
                routingControl.spliceWaypoints(0, 1, startPoint);
                startMarker = L.marker(startPoint).addTo(map).bindPopup(e.geocode.name).openPopup();
            } else if (!endPoint) {
                endPoint = latlng;
                routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1, 1, endPoint);
                endMarker = L.marker(endPoint).addTo(map).bindPopup(e.geocode.name).openPopup();
                calculateDistance(); // Calculate distance once both points are set
            } else {
                // Reset start and end points
                startPoint = latlng;
                endPoint = null;
                routingControl.setWaypoints([startPoint]);
                if (startMarker) {
                    map.removeLayer(startMarker);
                }
                startMarker = L.marker(startPoint).addTo(map).bindPopup(e.geocode.name).openPopup();
                if (endMarker) {
                    map.removeLayer(endMarker);
                }
                map.eachLayer(function (layer) {
                    if (layer instanceof L.Marker && !layer.options.icon.options.className.includes('leaflet-marker-icon leaflet-zoom-animated leaflet-interactive')) {
                        map.removeLayer(layer);
                    }
                });
            }
        }).addTo(map);

        function onMapClick(e) {
            var latlng = e.latlng;
            geocoder.reverse(latlng, map.options.crs.scale(map.getZoom()), function(results) {
                var result = results[0];
                if (result) {
                    if (!startPoint) {
                        startPoint = latlng;
                        routingControl.spliceWaypoints(0, 1, startPoint);
                        startMarker = L.marker(startPoint).addTo(map);
                        document.getElementById("startAddress").value = result.name;
                    } else if (!endPoint) {
                        endPoint = latlng;
                        routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1, 1, endPoint);
                        endMarker = L.marker(endPoint).addTo(map);
                        document.getElementById("endAddress").value = result.name;
                        calculateDistance(); // Calculate distance once both points are set
                    } else {
                        // Reset start and end points
                        startPoint = latlng;
                        endPoint = null;
                        routingControl.setWaypoints([startPoint]);
                        if (startMarker) {
                            map.removeLayer(startMarker);
                        }
                        startMarker = L.marker(startPoint).addTo(map).bindPopup(result.name).openPopup();
                        if (endMarker) {
                            map.removeLayer(endMarker);
                        }
                        map.eachLayer(function (layer) {
                            if (layer instanceof L.Marker && !layer.options.icon.options.className.includes('leaflet-marker-icon leaflet-zoom-animated leaflet-interactive')) {
                                map.removeLayer(layer);
                            }
                        });
                    }
                }
            });
        }
           // Function to geocode addresses and update the map
        function geocodeAddresses() {
            var startAddress = document.getElementById("startAddress").value;
            var endAddress = document.getElementById("endAddress").value;

            if (startAddress) {
                geocoder.geocode(startAddress, function(results) {
                    if (results && results.length > 0) {
                        var result = results[0];
                        startPoint = result.center;
                        routingControl.spliceWaypoints(0, 1, startPoint);
                        if (startMarker) {
                            map.removeLayer(startMarker);
                        }
                        startMarker = L.marker(startPoint).addTo(map).bindPopup(result.name).openPopup();
                        checkRoute();
                    } else {
                        alert("Start address not found");
                    }
                });
            }

            if (endAddress) {
                geocoder.geocode(endAddress, function(results) {
                    if (results && results.length > 0) {
                        var result = results[0];
                        endPoint = result.center;
                        routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1, 1, endPoint);
                        if (endMarker) {
                            map.removeLayer(endMarker);
                        }
                        endMarker = L.marker(endPoint).addTo(map).bindPopup(result.name).openPopup();
                        checkRoute();
                    } else {
                        alert("End address not found");
                    }
                });
            }
        }

        // Check if both points are set and calculate distance
        function checkRoute() {
            if (startPoint && endPoint) {
                calculateDistance();
            }
        }

         fetch('config.json')
            .then(response => response.json())
            .then(data => {
                prixKilometer = data.prixKilometer;
            })
            .catch(error => console.error('Error loading configuration:', error));

        function calculateDistance() {
            var from = turf.point([startPoint.lng, startPoint.lat]);
            var to = turf.point([endPoint.lng, endPoint.lat]);
            var options = {units: 'kilometers'};

            var distance = turf.distance(from, to, options);
            var cost = distance * prixKilometer;
            document.getElementById("distance").value = distance.toFixed(2) + " km";
             document.getElementById("cost").value = cost.toFixed(2);
            
            // Optionally, you can display the distance on the map as a popup
            var midpoint = L.latLng(
                (startPoint.lat + endPoint.lat) / 2,
                (startPoint.lng + endPoint.lng) / 2
            );
            L.popup()
                .setLatLng(midpoint)
                .setContent("Direct Distance: " + distance.toFixed(2) + " km")
                .openOn(map);
        }
map.on('click', onMapClick);

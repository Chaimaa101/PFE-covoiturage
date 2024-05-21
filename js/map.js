        var map = L.map('map').setView([31.792305849269,-7.080168000000015],6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function reverseGeocode(lat, lon) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`)
                .then(response => response.json())
                .then(data => {
                    alert(`Address: ${data.display_name}`);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lon = e.latlng.lng;
            reverseGeocode(lat, lon);
             var newMarker = L.marker([lat,lng]).addTo(map);

      });

         function geocode(address, callback) {
             fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${address}`)
                 .then(response => response.json())
                 .then(data => {
                     if (data.length > 0) {
                         callback(data[0]);
                     } else {
                         alert('Address not found: ' + address);
                     }
                 })
                 .catch(error => {
                     console.error('Error:', error);
                 });
         }

         function geocodePoints() {
             var startAddress = document.getElementById('start').value;
             var endAddress = document.getElementById('end').value;

             geocode(startAddress, function(start) {
                 var startLat = start.lat;
                 var startLon = start.lon;
                 var startMarker = L.marker([startLat, startLon]).addTo(map)
                     .bindPopup('Start: ' + start.display_name)
                     .openPopup();
                 map.setView([startLat, startLon], 13);

                 geocode(endAddress, function(end) {
                     var endLat = end.lat;
                     var endLon = end.lon;
                     var endMarker = L.marker([endLat, endLon]).addTo(map)
                         .bindPopup('End: ' + end.display_name)
                         .openPopup();
                         map.setView([endLat, rndLon], 13);
                 });
             });
         }
           var startAutocomplete = places({
             appId: 'R53O4BDH6P',
             apiKey: '9ed6db3b74190aaee3c84e66ac1106a8',
             container: document.querySelector('#start')
         });

         var endAutocomplete = places({
             appId: 'R53O4BDH6P',
             apiKey: '9ed6db3b74190aaee3c84e66ac1106a8',
             container: document.querySelector('#end')
         });


 L.control.measure({
     primaryAreaUnit: 'kilometrs',
     secondaryAreaUnit: 'metrs',
     primaryAreaUnit: 'kilometrs',
   secondaryAreaUnit: 'metrs',
   
   
 }).addTo(map) 
<script>
    // Creating map view
    var markermap = L.map('markermapid').setView([5.3836, 102.0712], 12);

    // Creating map options
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '',
        maxZoom: 18,
        id: 'mapbox/streets-v10', //mapbox/streets-v11 //mapbox/light-v10 //mapbox/dark-v10 //
        tileSize: 512,
        zoomOffset: -1,
        accessToken: '{{env('MAPBOX_PUBLIC_TOKEN')}}'
    }).addTo(markermap);

    // Adding marker
    var markerselect = L.marker([-39,146],{
    draggable: true
    }).addTo(markermap);

    // Extract longitude/latitude into form
    markerselect.on('dragend', function(e) {
    document.getElementById('latitude').value = markerselect.getLatLng().lat;
    document.getElementById('longitude').value = markerselect.getLatLng().lng;
    });

    markerselect.on('dragend', function (e) {
        updateLatLng(markerselect.getLatLng().lat, markerselect.getLatLng().lng);
        });
    markermap.on('click', function (e) {
    markerselect.setLatLng(e.latlng);
    updateLatLng(markerselect.getLatLng().lat, markerselect.getLatLng().lng);
    });

    function updateLatLng(lat,lng,reverse) {
    if(reverse) {
    marker.setLatLng([lat,lng]);

    } else {
    document.getElementById('latitude').value = markerselect.getLatLng().lat;
    document.getElementById('longitude').value = markerselect.getLatLng().lng;

    }
    }


</script>

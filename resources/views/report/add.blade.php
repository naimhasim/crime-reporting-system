  <!-- Modal -->
  <div class="modal fade" id="AddReportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="POST" id="addreportform" enctype="multipart/form-data">
    <div class="modal-dialog">

        <div class="modal-content">  {{-- modal content --}}
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body"> {{-- modal body --}}
                <ul id="saveform_errList"></ul>

                <div class="px-1 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Your Name</label>
                    <input type="text" class="form-control fullname" placeholder="Enter Title">
                </div>
                <div class="px-1 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                    <input type="text" class="form-control phoneno" placeholder="Enter Title">
                </div>
                <div class="px-1 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Report title</label>
                    <input type="text" class="form-control report_title" placeholder="What does report is about?">
                </div>

                <div class="px-1 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">What is happening?</label>
                    <textarea class="form-control report_desc" id="exampleFormControlTextarea1" rows="3" placeholder="In-depth explanation..."></textarea>
                  </div>

                <label for="formFile" class="form-label">Crime Category</label>
                <div class="input-group px-1 mb-3">

                    <select class="form-select crime_category" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="Housebreak">Housebreak</option>
                        <option value="Robbery">Robbery</option>
                        <option value="Theft">Theft</option>
                        <option value="Motor vehicle theft">Motor Vehicle Theft</option>
                        <option value="Assault">Assault</option>
                    </select>
                </div>
                <div class="px-1 mb-3">
                    <label for="formFile" class="form-label">Do you have photo? (optional)</label>
                    <input class="form-control report_media" type="file" id="inputGroupFile02">
                </div>
                <div class="px-1 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address (optional)</label>
                    <input type="email" class="form-control email" placeholder="name@example.com">
                </div>

                <label for="exampleFormControlInput1" class="form-label">Location</label>
                <div class="map-container">
                    <div class="map-marker-centered"></div>
                    <div id="markermapid" class="map"></div>
                </div>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Latitude&nbsp;&nbsp;&nbsp;</span>
                    <input id="latitude" type="text" class="form-control latitude" placeholder="Drag marker" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Longitude</span>
                    <input id="longitude" type="text" class="form-control longitude" placeholder="in map" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                {{-- dsfdassadsadsadasdsadasdsas --}}
                {{-- <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" class="form-control report_title" placeholder="Enter Report Title" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-text report_desc">Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <textarea class="form-control report_desc" aria-label="With textarea"></textarea>
                </div>
                <br>
                <div class="input-group mb-3">
                    <input type="file" class="form-control report_media" id="inputGroupFile02">
                  </div>

                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Crime Category</label>
                    <select class="form-select crime_category" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="Housebreak">Housebreak</option>
                        <option value="Robbery">Robbery</option>
                        <option value="Theft">Theft</option>
                        <option value="Motor vehicle theft">Motor Vehicle Theft</option>
                        <option value="Assault">Assault</option>
                    </select>
                </div>


                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Latitude&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input id="latitude" type="text" class="form-control latitude" placeholder="Drag marker" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Longitude&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input id="longitude" type="text" class="form-control longitude" placeholder="in map" aria-label="Username" aria-describedby="basic-addon1">
                </div> --}}


            </div>

            <div class="modal-footer"> {{-- modal footer --}}
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary add_report">Save</button>
            </div>
        </div>

    </div>
    </form>
  </div>

<script>
// Creating map view
var markermap = L.map('markermapid').setView([5.3836, 102.0712], 12);

// Creating map options
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {

    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibmFpbWhhc2ltIiwiYSI6ImNrdmFxaGYzbTJsOGgydnA2OWVhZHoxOWIifQ.HpzTWE563N64yu0JYi251w'
}).addTo(markermap);


// Adding marker
var markerselect = L.marker([6.1247846,102.2368729],{
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

$('#markermapid').on('shown.bs.tab', function (e) {
    //call the clear map event first
    clearMap();
    //resize the map - this is the important part for you
   map.invalidateSize(true);
   //load the map once all layers cleared
   loadMap();
})
</script>


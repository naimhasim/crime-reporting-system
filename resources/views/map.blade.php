@extends('layouts.app')

@section('content')
    <!--sidebar container-->
    @include('layouts.sidebar')

      <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

    <!--Map content-->

    <div id="mapid"> <!--leaflet map div -->>
        <div class="leaflet-bottom leaflet-left">
            <div id="marker-legend">  <!-- here the legend -->

            </div>
        </div>
    </div>



    <script>
        //map setup//
        var mymap = L.map('mapid').setView([6.054874, 102.2948662], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1 }).addTo(mymap);
        //end map setup //

        //add sidebar//
        var sidebar = L.control.sidebar('sidebar', {
            closeButton: true,
            position: 'right'
        });
        mymap.addControl(sidebar);

        setTimeout(function () { //show within 500ms
            sidebar.show();
        }, 500);

        //add marker//
        var marker = L.marker([6.0548687, 102.2948662]).addTo(mymap).on('click', function () {
            sidebar.toggle();//xperlu toggle sbb nk toggle di sidebar
            var latLngs = [ marker.getLatLng() ]; //https://gist.github.com/marciogoularte/1c546a1c23f41eb6d1b08410bf99e868#file-centerleafletmaponmarker-js
            var markerBounds = L.latLngBounds(latLngs);
            mymap.fitBounds(markerBounds);

        });
        //end sidebar & marker //

    </script>

    <script src="{{asset('js/leaflet-sidebar.js')}}"></script>
@endsection

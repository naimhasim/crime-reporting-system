@extends('layouts.app')

@section('content')

      <!-- Modal -->
    @include('report.add')
  <style>
     #map-wrapper {
    width: 100%;
    height: 100%;
    position: relative;
    border: 1px solid black;
    }

    #button-wrapper {
    position: absolute;
    margin: auto;
    bottom: 10%;
    left: 0;
    right: 0;
    width: 100%;
    border: 1px solid red;
    }
    .leaflet-left{
        pointer-events: auto;
    }

    #reportmedia {
        width: 100%;
        height: 100%;
    }
  </style>

    <!--content----->
    <div class="span9" style="height:100%">
        <div id="map-wrapper" >
            @include('layouts.sidebar')
            <div id="mapid"></div> <!--leaflet map div -->
            <div id="button-wrapper" >
                <button type="button" class=" btn btn-dark leaflet-left leaflet-top" data-bs-toggle="modal" data-bs-target="#AddReportModal">
                    I want to report
                  </button>

                </div>
            </div>

        </div>
    </div>

    <!--content-end-->
@endsection

{{-- scripts start --}}
@section('scripts')

<script> //MAP COMPONENT

    // Creating map view
    var mymap = L.map('mapid').setView([5.3836, 102.0712], 9.45);

    // Creating map options

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '',
        maxZoom: 18,
        id: 'mapbox/light-v10', //mapbox/streets-v11 //mapbox/light-v10 //mapbox/dark-v10 //
        tileSize: 512,
        zoomOffset: -1,
        accessToken: '{{env('MAPBOX_PUBLIC_TOKEN')}}'
    }).addTo(mymap);

    @include('layouts.kelantanborder')
    var geoStyle = {
    "opacity": 1,
    // "color": "blue",
    "fillOpacity": 0.03 // value between 0-1 or 0% - 100%
    };

    L.geoJSON(mygeojson, {style: geoStyle}).addTo(mymap)
    //L.control.locate().addTo(mymap);
    var ctlsidebar = L.control.sidebar('sidebar').addTo(mymap);
    var ctleasybutton = L.easyButton('fa-exchange', function () {
        ctlsidebar.toggle();
        console.log("clicked");
    }).addTo(mymap);

    // // Adding map markers
    // var marker = L.marker([6.1247846,102.2368729]).addTo(mymap);

    // // Click marker to zoom in
    // marker.on('click',
    //     function(){
    //         var latlngs = [ marker.getLatLng() ];
    //         var markerBounds = L.latLngBounds(latlngs);
    //         mymap.fitBounds(markerBounds);
    //     }
    // );

</script>

<script> // ADDING/FETCH REPORT COMPONENTS
    $(document).ready(function () {

        showallreport();
        showchart();

        function showchart()
        {
            $.ajax({
                type: "GET",
                url: "show-chart",
                dataType: "json",
                success: function (response)
                {
                    console.log(response.chartData);
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Crime Category', 'Number of reports '],
                            [response.chartData[0].crime_category,response.chartData[0].total],
                            [response.chartData[1].crime_category,response.chartData[1].total],
                            [response.chartData[2].crime_category,response.chartData[2].total],
                            [response.chartData[3].crime_category,response.chartData[3].total],
                            [response.chartData[4].crime_category,response.chartData[4].total],

                        ]);

                        var options = {
                        title: 'Crime Category Chart'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }

                ;}
            });

        }

        function showallreport()
        {
            $.ajax({
                type: "GET",
                url: "showall-report",
                dataType: "json",
                success: function (response)
                {
                    var LeafIcon = L.Icon.extend({
                        options: {
                            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                            //iconSize:     [38, 95],
                            //shadowSize:   [50, 64],
                            //iconAnchor:   [22, 94],
                            //shadowAnchor: [4, 62],
                            //popupAnchor:  [-3, -76]
                        }
                    });

                    console.log(response.report);
                    var clusterpoint = L.markerClusterGroup();

                    $.each(response.report, function (key, item) {

                        if (item.crime_category == "Theft" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png'}) //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon})
                            .addTo(mymap)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border bg-primary' style=''><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>\
                            &nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        else if (item.crime_category == "Housebreak" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png'}) //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon})
                            .addTo(mymap)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:indigo;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>\
                            &nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        else if (item.crime_category == "Robbery" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png'}) //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon})
                            .addTo(mymap)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block bg-danger border'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>\
                            &nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        else if (item.crime_category == "Motor vehicle theft" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png'}) //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon})
                            .addTo(mymap)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block bg-success border'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>\
                            &nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        else if (item.crime_category == "Assault" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png'}) //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon})
                            .addTo(mymap)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:orange;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>\
                            &nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        mymap.addLayer(clusterpoint);

                    })
                ;}
            });

        }

        $(document).on('click', '.add_report', function (e) {
            e.preventDefault();
            let fullname     = $('.fullname').val();
            let phoneno      = $(".phoneno").val();
            let email        = $(".email").val();
            let report_title = $(".report_title").val();
            let report_desc  = $('textarea.report_desc').val();
            let report_media = document.getElementById('inputGroupFile02').files[0];
            let crime_category = $(".crime_category").val();
            let latitude     = $(".latitude").val();
            let longitude    = $(".longitude").val();
            let _token       = $('meta[name="csrf-token"]').attr('content');

            var form_data = new FormData();
            form_data.append("fullname", fullname)
            form_data.append("phoneno",phoneno)
            form_data.append("email",email)
            form_data.append("report_title", report_title )
            form_data.append("report_desc", report_desc )
            form_data.append("report_media", report_media )
            form_data.append("crime_category", crime_category )
            form_data.append("latitude", latitude )
            form_data.append("longitude", longitude )
            form_data.append("_token", _token)

            // var data = {
                // 'report_title': $('.report_title').val(),
                // 'report_desc': $('textarea').val(),
                // 'report_media': $('.report_media').val(),
                // 'crime_category': $('.crime_category').val(),
                // 'latitude': $('.latitude').val(),
                // 'longitude': $('.longitude').val(),
            // }
            //console.log(data);

            $.ajax({
                type: "POST",
                url: "/",
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if(response.status == 400)
                    {
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values) {
                            $('#saveform_errList').append('<li>'+err_values+'</li');

                        });
                    }
                    else
                    {
                        $('#saveform_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message)
                        $('#AddReportModal').modal('hide');
                        $("#addreportform").trigger("reset");
                        alert(response.message);
                        showallreport();
                        showchart();
                    }
                }
            });

        });
    });


</script>

@endsection
{{-- Scripts End --}}

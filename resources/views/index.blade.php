@extends('layouts.app')

@section('content')
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

      <!-- Modal -->
    @include('report.add')


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
    // var ctleasybutton = L.easyButton('fa fa-gear', function () {
    //     ctlsidebar.toggle();
    // }).addTo(mymap);
    var ctlviewchart = L.easyButton
    (
        {
            states:
            [
                {
                    stateName: 'zoom-to-forest',        // name the state
                    icon:      'fa fa-gear',               // and define its properties
                    title:     'View Charts',      // like its title
                    onClick: function(btn, map)
                    {       // and its callback
                        ctlsidebar.toggle();
                        btn.state('zoom-to-school');    // change state on click!
                    }
                },
            ]
        }
    ).addTo(mymap);

    var ctlcentermap = L.easyButton
    (
        {
            states:
            [
                {
                    stateName: 'zoom-to-forest',        // name the state
                    icon:      'fa fa-arrows',               // and define its properties
                    title:     'Pan out to Kelantan',      // like its title
                    onClick: function(btn, map)
                    {       // and its callback
                        map.setView([5.4274, 102.0407],9.45);
                        btn.state('zoom-to-school');    // change state on click!
                    }
                },

                // {
                //     stateName: 'zoom-to-school',
                //     icon:      'fa-university',
                //     title:     'zoom to a school',
                //     onClick: function(btn, map)
                //     {
                //         map.setView(mymap.getCenter(),16);
                //         btn.state('zoom-to-forest');
                //     }
                // }
            ]
        }
    ).addTo(mymap);
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
                    console.log(response.categorychart);
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Crime Category', 'Number of reports '],
                            [response.categorychart[0].crime_category,response.categorychart[0].total],
                            [response.categorychart[1].crime_category,response.categorychart[1].total],
                            [response.categorychart[2].crime_category,response.categorychart[2].total],
                            [response.categorychart[3].crime_category,response.categorychart[3].total],
                            [response.categorychart[4].crime_category,response.categorychart[4].total],

                        ]);

                        var options = {
                        // title: 'Crime Category Chart',
                        titleTextStyle: {
                            color: 'black',
                            fontName: 'Helvetica',
                            fontSize: 'large',
                            bold: true,
                            italic: true },
                        pieHole: 0.3,
                        backgroundColor : '#f3f3f3',
                        colors:['orange','purple','#0dbc00','red','#4365ff'],
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('crimecategory_chart'));

                        chart.draw(data, options);
                    }

                ;}
            });

            $.ajax({
                type: "GET",
                url: "show-chart",
                dataType: "json",
                success: function (response)
                {
                    console.log(response.districtchart);
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);



                    function drawChart() {
                        var district=[
                        0, //'Kota Bharu'  0
                        0, //'Pasir Mas'   1
                        0, //'Tumpat'      2
                        0, //'Pasir Puteh' 3
                        0, //'Bachok'      4
                        0, //'Kuala Krai'  5
                        0, //'Machang'     6
                        0, //'Tanah Merah' 7
                        0, //'Jeli'        8
                        0  //'Gua Musang'  9
                        ];

                        for(var i=0 ; i < response.districtchart.length ; i++){
                            if(response.districtchart[i].district == "Kota Bharu" ||
                                    response.districtchart[i].district == "Badang"||
                                    response.districtchart[i].district == "Beta"||
                                    response.districtchart[i].district == "Banggu"||
                                    response.districtchart[i].district == "Kadok"||
                                    response.districtchart[i].district == "Kemumin"||
                                    response.districtchart[i].district == "Kota"||
                                    response.districtchart[i].district == "Kubang Kerian"||
                                    response.districtchart[i].district == "Ketereh"||
                                    response.districtchart[i].district == "Limbat"||
                                    response.districtchart[i].district == "Panji"||
                                    response.districtchart[i].district == "Pendek"||
                                    response.districtchart[i].district == "Peringat"||
                                    response.districtchart[i].district == "Salor"||
                                    response.districtchart[i].district == "Sering"||
                                    response.districtchart[i].district == "Pusat Bandar Kota Bharu"||
                                    response.districtchart[i].district == "Melor"){
                                district[0] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Pasir Mas" ||
                                    response.districtchart[i].district == "Rantau Panjang"||
                                    response.districtchart[i].district == "Kangkong"||
                                    response.districtchart[i].district == "Gual Periok"||
                                    response.districtchart[i].district == "Chetok"||
                                    response.districtchart[i].district == "Alor Pasir"||
                                    response.districtchart[i].district == "Lemal"||
                                    response.districtchart[i].district == "Bunut Susu"||
                                    response.districtchart[i].district == "Kubang Sepat"||
                                    response.districtchart[i].district == "Kubang Gadong"){
                                district[1] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Tumpat"||
                                    response.districtchart[i].district == "Jal"||
                                    response.districtchart[i].district == "Pengkalan Kubor"||
                                    response.districtchart[i].district == "Sungai Pinang"||
                                    response.districtchart[i].district == "Terbak"||
                                    response.districtchart[i].district == "Kebakat"||
                                    response.districtchart[i].district == "Wakaf Bharu"){
                                district[2] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Pasir Puteh"||
                                    response.districtchart[i].district == "Bukit Jawa"||
                                    response.districtchart[i].district == "Padang Pak Amat"||
                                    response.districtchart[i].district == "Limbongan"||
                                    response.districtchart[i].district == "Jeram"||
                                    response.districtchart[i].district == "Bukit Awang"||
                                    response.districtchart[i].district == "Bukit Abal"||
                                    response.districtchart[i].district == "Gong Datok"||
                                    response.districtchart[i].district == "Semerak" ){
                                district[3] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Bachok" ||
                                    response.districtchart[i].district == "Mahligai"||
                                    response.districtchart[i].district == "Telong"||
                                    response.districtchart[i].district == "Gunong"||
                                    response.districtchart[i].district == "Melawi"||
                                    response.districtchart[i].district == "Tanjung Pauh"||
                                    response.districtchart[i].district == "Tawang"||
                                    response.districtchart[i].district == "Bekelam"){
                                district[4] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Kuala Krai"||
                                    response.districtchart[i].district == "Dabong"||
                                    response.districtchart[i].district == "Olak Jeram"||
                                    response.districtchart[i].district == "Mengkebang" ){
                                district[5] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Machang"||
                                    response.districtchart[i].district == "Labok"||
                                    response.districtchart[i].district == "Ulu Sat"||
                                    response.districtchart[i].district == "Temangan"||
                                    response.districtchart[i].district == "Pangkal Meleret"||
                                    response.districtchart[i].district == "Pulai Chondong"||
                                    response.districtchart[i].district == "Panyit" ){
                                district[6] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Tanah Merah"||
                                    response.districtchart[i].district == "Bukit Panau"||
                                    response.districtchart[i].district == "Ulu Kusial"||
                                    response.districtchart[i].district == "Jedok"){
                                district[7] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Jeli"||
                                    response.districtchart[i].district == "Kuala Balah"||
                                    response.districtchart[i].district == "Batu Melintang"){
                                district[8] += response.districtchart[i].total;
                            }
                            else if(response.districtchart[i].district == "Gua Musang"||
                                    response.districtchart[i].district == "Galas"||
                                    response.districtchart[i].district == "Bertam"||
                                    response.districtchart[i].district == "Chiku" ){
                                district[9] += response.districtchart[i].total;
                            }else{
                                console.log("District Chart:"+ response.districtchart[i].district +" not found");
                            }
                        }
                        var data = google.visualization.arrayToDataTable([
                            ['Crime Category', 'Number of reports '],
                            ['Kota Bharu' ,district[0]],
                            ['Pasir Mas'  ,district[1]],
                            ['Tumpat'     ,district[2]],
                            ['Pasir Puteh',district[3]],
                            ['Bachok'     ,district[4]],
                            ['Kuala Krai' ,district[5]],
                            ['Machang'    ,district[6]],
                            ['Tanah Merah',district[7]],
                            ['Jeli'       ,district[8]],
                            ['Gua Musang' ,district[9]],

                        ]);

                        var options = {
                        // title: 'District Chart',
                        titleTextStyle: {
                            color: 'black',
                            fontName: 'Helvetica',
                            fontSize: 'large',
                            bold: true,
                            italic: true },
                        // pieHole: 0.35,
                        backgroundColor : '#f3f3f3',
                        // colors:['orange','purple','#0dbc00','red','#4365ff'],
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('district_chart'));

                        chart.draw(data, options);
                    }

                ;}
            });

        }

        function showallreport()
        {
            var group1 = new L.layerGroup(),
                group2 = new L.layerGroup(),
                group3 = new L.layerGroup(),
                group4 = new L.layerGroup(),
                group5 = new L.layerGroup();
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
                    var clusterpoint = L.markerClusterGroup.layerSupport();

                    $.each(response.report, function (key, item) {

                        if (item.crime_category == "Theft" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png'}) //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon})
                            .addTo(group1)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border bg-primary' style=''><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
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
                            .addTo(group2)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:indigo;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
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
                            .addTo(group3)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block bg-danger border'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
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
                            .addTo(group4)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block bg-success border'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
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
                            .addTo(group5)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:orange;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
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
                        clusterpoint.addTo(mymap);

                    })



                ;}
            });


                    var overlayMaps = {
                        "Theft": group1,
                        "Housebreak": group2,
                        "Robbery": group3,
                        "Motor Vehicle Theft": group4,
                        "Assault": group5,
                    }

                    var control = L.control.layers(null, overlayMaps).addTo(mymap);

                    group1.addTo(mymap);
                    group2.addTo(mymap);
                    group3.addTo(mymap);
                    group4.addTo(mymap);
                    group5.addTo(mymap);
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

@include('report.add_script')
@endsection
{{-- Scripts End --}}

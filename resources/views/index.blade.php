@extends('layouts.app')
@section('content')

    @include('report.addmodal')



    <!--content----->
    <div class="span9">
        <div id="map-wrapper" >
            @include('report.sidebar')
            <div id="mapid"></div> <!--leaflet map div -->
            <div id="button-wrapper" >
                <button type="button" class="rounded-pill btn btn-primary leaflet-bottom leaflet-left" style="pointer-events: auto; width: ; height: ;" data-bs-toggle="modal" data-bs-target="#AddReportModal">
                    <b style="font-size: large; color: white;">Add report<b>
                </button>
            </div>
        </div>
        <div id="github-wrapper" style="background-color: #6e5494">
            <div class="" style="display:flex; justify-content: center;  align-items: center; color:white;background-color: ;font-size: 15px; padding-bottom:5px">
                <span style="margin-right: 6px;">Powered by</span>
                <a style="color:white" href="https://github.com/naimhasim/crime-reporting-system#readme">Naim Hasim</a></div>
        </div>
    </div>

@endsection
<!--content--section-end-->

{{-- scripts--section--start --}}
@section('scripts')

<script>

function showallreport()
        {
            clusterpoint.clearLayers();
            group1.clearLayers();
            group2.clearLayers();
            group3.clearLayers();
            group4.clearLayers();
            group5.clearLayers();

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


                    $.each(response.report, function (key, item) {

                        if (item.crime_category == "Theft" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png'}); //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon, title: item.crime_category})
                            .addTo(group1)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border bg-primary' style=''><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:;'><h8 class='mt-2 mx-2 text-center' style='color: black;'><strong>"+item.crime_date+"</strong></h8></div>"
                            +"<a href='localhost:8000/marker/"+item.id+"' class='rounded-pill  d-inline-block border btn btn-sm btn-outline-danger py-0' style='color:red;' id='deleteMarker' data-id='"+item.id+"'><strong>Delete</strong></a>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>"
                            +"&nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        else if (item.crime_category == "Housebreak" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png'}); //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon, title: item.crime_category})
                            .addTo(group2)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:indigo;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:;'><h8 class='mt-2 mx-2 text-center' style='color: black;'><strong>"+item.crime_date+"</strong></h8></div>"
                            +"<a href='localhost:8000/marker/"+item.id+"' class='rounded-pill  d-inline-block border btn btn-sm btn-outline-danger py-0' style='color:red;' id='deleteMarker' data-id='"+item.id+"'><strong>Delete</strong></a>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>"
                            +"&nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        else if (item.crime_category == "Robbery" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png'}); //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon, title: item.crime_category})
                            .addTo(group3)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block bg-danger border'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:;'><h8 class='mt-2 mx-2 text-center' style='color: black;'><strong>"+item.crime_date+"</strong></h8></div>"
                            +"<a href='localhost:8000/marker/"+item.id+"' class='rounded-pill  d-inline-block border btn btn-sm btn-outline-danger py-0' style='color:red;' id='deleteMarker' data-id='"+item.id+"'><strong>Delete</strong></a>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>"
                            +"&nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        else if (item.crime_category == "Motor vehicle theft" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png'}); //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon, title: item.crime_category})
                            .addTo(group4)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block bg-success border'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:;'><h8 class='mt-2 mx-2 text-center' style='color: black;'><strong>"+item.crime_date+"</strong></h8></div>"
                            +"<a href='localhost:8000/marker/"+item.id+"' class='rounded-pill  d-inline-block border btn btn-sm btn-outline-danger py-0' style='color:red;' id='deleteMarker' data-id='"+item.id+"'><strong>Delete</strong></a>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>"
                            +"&nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        else if (item.crime_category == "Assault" )
                        {
                            var Icon = new LeafIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png'}); //marker icon

                            var marker = L.marker([item.latitude,item.longitude], {icon: Icon, title: item.crime_category})
                            .addTo(group5)
                            .bindPopup
                            (
                            "<h4 class='mb-1'>" + item.report_title + "</h4> "
                            +"<img class='img-same-size mb-2' id ='reportmedia' src='uploads/report/"+item.report_media+"'/>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:orange;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.crime_category+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:black;'><h8 class='mt-2 mx-2 text-center' style='color: white;'><strong>"+item.district+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border mb-2 alig'><h8 class='mt-2 mx-2 text-center' style='color: ;'><strong>"+parseFloat(item.latitude).toFixed(5)+","+parseFloat(item.longitude).toFixed(5)+"</strong></h8></div>"
                            +"<div class='rounded-pill  d-inline-block border' style='background-color:;'><h8 class='mt-2 mx-2 text-center' style='color: black;'><strong>"+item.crime_date+"</strong></h8></div>"
                            +"<a href='localhost:8000/marker/"+item.id+"' class='rounded-pill  d-inline-block border btn btn-sm btn-outline-danger py-0' style='color:red;' id='deleteMarker' data-id='"+item.id+"'><strong>Delete</strong></a>"
                            +"<div class='' style='background-color: #f1f3f5; border-radius: 0rem 1rem;'><h6 class='p-2'>"+item.report_desc+"</h6></div>"
                            +"<small>For enquiries, please contact :</small><br>"
                            +"<strong><h10>"+item.fullname+" ("+item.email+")</h10></strong>&nbsp;&nbsp;&nbsp;<br>"
                            +"<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green' href='tel:+6"+item.contact_no+"'>Call</a></button>"
                            +"&nbsp;<button type='button' class='btn btn-outline-success btn-sm' style='border-radius:0.8rem'><a style='color:green'  href='https://api.whatsapp.com/send?phone=6"+item.contact_no+"'>Whatsapp</a></button><br>"
                            )
                            .openPopup();
                            clusterpoint.addLayer(marker);
                        }
                        clusterpoint.addTo(mymap);

                    })

                ;}
            });



            group1.addTo(mymap);
            group2.addTo(mymap);
            group3.addTo(mymap);
            group4.addTo(mymap);
            group5.addTo(mymap);

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
                        tooltip: { trigger: 'selection' }
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('crimecategory_chart'));

                        chart.setAction({
                            id:'showmarker',
                            text: 'Show',
                            action: function(){
                                selection = chart.getSelection();
                                switch (selection[0].row) {
                                    case 0: mymap.addLayer(group5); mymap.removeLayer(group1); mymap.removeLayer(group2); mymap.removeLayer(group3); mymap.removeLayer(group4); break;
                                    case 1: mymap.removeLayer(group5); mymap.removeLayer(group1); mymap.addLayer(group2); mymap.removeLayer(group3); mymap.removeLayer(group4); break;
                                    case 2: mymap.removeLayer(group5); mymap.removeLayer(group1); mymap.removeLayer(group2); mymap.removeLayer(group3); mymap.addLayer(group4); break;
                                    case 3: mymap.removeLayer(group5); mymap.removeLayer(group1); mymap.removeLayer(group2); mymap.addLayer(group3); mymap.removeLayer(group4); break;
                                    case 4: mymap.removeLayer(group5); mymap.addLayer(group1); mymap.removeLayer(group2); mymap.removeLayer(group3); mymap.removeLayer(group4); break;
                                }
                            }
                        });

                        chart.setAction({
                            id:'undomarker',
                            text: 'Show All',
                            action: function(){
                                selection = chart.getSelection();
                                switch (selection[0].row) {
                                    case 0: mymap.addLayer(group5); mymap.addLayer(group1); mymap.addLayer(group2); mymap.addLayer(group3); mymap.addLayer(group4); break;
                                    case 1: mymap.addLayer(group5); mymap.addLayer(group1); mymap.addLayer(group2); mymap.addLayer(group3); mymap.addLayer(group4); break;
                                    case 2: mymap.addLayer(group5); mymap.addLayer(group1); mymap.addLayer(group2); mymap.addLayer(group3); mymap.addLayer(group4); break;
                                    case 3: mymap.addLayer(group5); mymap.addLayer(group1); mymap.addLayer(group2); mymap.addLayer(group3); mymap.addLayer(group4); break;
                                    case 4: mymap.addLayer(group5); mymap.addLayer(group1); mymap.addLayer(group2); mymap.addLayer(group3); mymap.addLayer(group4); break;
                                }
                            }
                        });
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
                                console.log("District '"+ response.districtchart[i].district +"' is not found");
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


</script>

@include('report.addmodal_script')

<script> //MAP COMPONENT

    // Creating map view
    var mymap = L.map('mapid').setView([5.4274, 102.0407], 9.45);

    // Creating map options
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery &copy; <a href="https://www.mapbox.com/about/maps/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11', //mapbox/streets-v11 //mapbox/light-v10 //mapbox/dark-v10 //
        tileSize: 512,
        zoomOffset: -1,
        accessToken: '{{env('MAPBOX_PUBLIC_TOKEN')}}'
    }).addTo(mymap);

    @include('layouts.kelantanborder') //contains var 'mygeojson'
    L.geoJSON(mygeojson, {
        style:{
            "fillOpacity": 0.03 // value between 0-1 or 0% - 100%
        }
    }).addTo(mymap)

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
                    stateName: 'view-chart',        // name the state
                    icon:      'fa fa-gear',               // and define its properties
                    title:     'View Charts',      // like its title
                    onClick: function(btn, map)
                    {       // and its callback
                        ctlsidebar.toggle();
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
                {           //STATE 1
                    stateName: 'zoom-to-kelantan',        // name the state
                    icon:      'fa fa-arrows',               // and define its properties
                    title:     'Zoom to Kelantan',      // like its title
                    onClick: function(btn, map)
                    {       // and its callback
                        map.setView([5.4274, 102.0407],9.45);
                        //btn.state('zoom-to-school');    // change state on click!
                    }
                },

                // {        //STATE 2
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

    var group1 = new L.layerGroup(),
        group2 = new L.layerGroup(),
        group3 = new L.layerGroup(),
        group4 = new L.layerGroup(),
        group5 = new L.layerGroup();
    var clusterpoint = L.markerClusterGroup.layerSupport();

    var streets = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: '',
                    maxZoom: 18,
                    id: 'mapbox/streets-v11', //mapbox/streets-v11 //mapbox/light-v10 //mapbox/dark-v10 //
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: '{{env('MAPBOX_PUBLIC_TOKEN')}}'
                }
    ),
    light = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: '',
                    maxZoom: 18,
                    id: 'mapbox/light-v10', //mapbox/streets-v11 //mapbox/light-v10 //mapbox/dark-v10 //
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: '{{env('MAPBOX_PUBLIC_TOKEN')}}'
                }
    ),
    dark = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: '',
                    maxZoom: 18,
                    id: 'mapbox/dark-v10', //mapbox/streets-v11 //mapbox/light-v10 //mapbox/dark-v10 //
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: '{{env('MAPBOX_PUBLIC_TOKEN')}}'
                }
    ),
    outdoor = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: '',
                    maxZoom: 18,
                    id: 'mapbox/outdoors-v10', //mapbox/streets-v11 //mapbox/light-v10 //mapbox/dark-v10 //
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: '{{env('MAPBOX_PUBLIC_TOKEN')}}'
                }
    ),
    satellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: '',
                    maxZoom: 18,
                    id: 'mapbox/satellite-v9', //mapbox/streets-v11 //mapbox/light-v10 //mapbox/dark-v10 //
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: '{{env('MAPBOX_PUBLIC_TOKEN')}}'
                }
    );

    var baseLayers = {
        "Streets" : streets,
        "Outdoors": outdoor,
        "Light"   : light,
        "Dark"    : dark,
        "Satellite" : satellite,

    };
    var overlayMaps = {
        "Theft": group1,
        "Housebreak": group2,
        "Robbery": group3,
        "Motor Vehicle Theft": group4,
        "Assault": group5,
    };

    var control = L.control.layers(baseLayers, overlayMaps).addTo(mymap);

    $(document).ready(function () {

        showallreport();

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
            let crimedate    = $(".crimedate").val();
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
            form_data.append("crimedate",crimedate)
            form_data.append("_token", _token)

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
                        $('#reportform_errList').html("").addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values) {
                            $('#reportform_errList').append('<li>'+err_values+'</li');

                        });
                    }
                    else
                    {
                        $('#saveform_errList').html(""); //x perlu
                        $('#success_message').addClass('alert alert-success'); //x perlu
                        $('#success_message').text(response.message)           //x perlu
                        $('#AddReportModal').modal('hide');
                        $("#addreportform").trigger("reset");
                        alert(response.message);
                        Swal.fire(
                        'Remind!',
                        response.message,
                        'success'
                        )
                        showallreport();
                    }
                }
            });

        });

        $("body").on("click","#deleteMarker",function(e){

            if(!confirm("Do you really want to do this?")) {
            return false;
            }

            e.preventDefault();
            var id     = $(this).data("id");
            // var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var url = e.target;

            $.ajax(
                {
                url: "marker/"+id, //or can use url: url.href,
                type: 'DELETE',
                data: {
                    _token: token,
                        id: id
                },
                success: function (response){

                    $("#success").html(response.message)

                    Swal.fire(
                    'Remind!',
                    'Marker deleted successfully!',
                    'success'
                    )
                    showallreport();
                }
            });
            return false;
        });

    });
</script>


@endsection
{{-- Scripts section -- End --}}

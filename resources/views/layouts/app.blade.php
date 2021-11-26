<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!--style-->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/leaflet-sidebar.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.1/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="{{asset('css/MarkerCluster.css')}}">
    <link rel="stylesheet" href="{{asset('css/MarkerCluster.Default.css')}}">
    <link rel="stylesheet" href="{{asset('css/easy-button.css')}}">
    <link rel="stylesheet" href="{{asset('css/L.Control.Sidebar.css')}}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@3.0.3/dist/esri-leaflet.js"
    integrity="sha512-kuYkbOFCV/SsxrpmaCRMEFmqU08n6vc+TfAVlIKjR1BPVgt75pmtU9nbQll+4M9PN2tmZSAgD1kGUCKL88CscA=="
    crossorigin=""></script>

    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.js"
    integrity="sha512-enHceDibjfw6LYtgWU03hke20nVTm+X5CRi9ity06lGQNtC9GkBNl/6LoER6XzSudGiXy++avi1EbIg9Ip4L1w=="
    crossorigin=""></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/leaflet.markercluster.js')}}"></script>
    <script src="{{asset('js/leaflet.markercluster.layersupport.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.1/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script src="{{asset('js/easy-button.js')}}"></script>
    <script src="{{asset('js/leaflet-sidebar.js')}}"></script>
    <script src="{{asset('js/L.Control.Sidebar.js')}}"></script>
</head>

<body>



    <!--Content-->
    <div>
        @yield('content')
    </div>


    <!--Footer-->
    <footer></footer>


    @yield('scripts')
</body>
</html>

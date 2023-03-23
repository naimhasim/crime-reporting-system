# **Crime Reporting System ([Demo](https://crimereporting-app.herokuapp.com/))**

<image src="images/home.png" width="">

---

## **Description**

The system allows users to lodge police report without having to go to the police station and view crime density as geospatial data using Leaflet interactive map.

### Technology Used

-   [Laravel](https://laravel.com/)
-   [Leaflet](http://leafletjs.com/)
-   [Google Charts](https://developers.google.com/chart)
-   [Markercluster](https://github.com/Leaflet/Leaflet.markercluster)    

<br>

<p float="left" align="center">
<image src="images/reportpopup.png" width="300">
<image src="images/reportform.png" width="300">
<image src="images/mapmarker.png" width="300">
<image src="images/ui.png" width="300">
</p>

---
## Installation
1. `composer install`
2. create `.env` file and copy `.env.example` content
3. `php artisan key:generate`
4. Grab your [mapbox API](https://account.mapbox.com/) here and assign to `MAPBOX_PUBLIC_TOKEN` environment variable

EXTRA !!

- Dump data from [crime.sql](https://github.com/naimhasim/crime-reporting-system/blob/main/crime.sql) to your database for testing purpose

---

## Credits

-   [Mapbox](https://www.mapbox.com/)
-   [OpenStreetMap](https://www.openstreetmap.org/)

---

## Author Info

-   Github - [Naim Hasim](https://github.com/naimhasim)

<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Leaflet</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
    <div id="map"></div>

    <script>
        var map;

        document.addEventListener('DOMContentLoaded', function () {
            // Initialiser la carte avec une vue par défaut (Paris)
            map = L.map('map').setView([48.8566, 2.3522], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Obtenir la position de l'utilisateur
            getLocation();
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("La géolocalisation n'est pas supportée par ce navigateur.");
            }
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            
            // Mettre à jour la vue de la carte avec la position de l'utilisateur
            map.setView([lat, lng], 13);

            // Ajouter un marqueur à la position de l'utilisateur
            L.marker([lat, lng]).addTo(map)
                .bindPopup('Vous êtes ici.')
                .openPopup();
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("L'utilisateur a refusé la demande de géolocalisation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Les informations de localisation sont non disponibles.");
                    break;
                case error.TIMEOUT:
                    alert("La demande de localisation a expiré.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Une erreur inconnue s'est produite.");
                    break;
            }
        }
    </script>
</body>
</html>

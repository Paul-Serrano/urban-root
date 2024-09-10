<div>
    <div id="map" style="height: 500px;"></div>
    @if($gardens)
    <div id="gardens-data" style="display: none;">
        @foreach($gardens as $index => $garden)
            <p class="garden" 
               data-name="{{ $garden->name }}" 
               data-lat="{{ $garden->latitude }}" 
               data-lon="{{ $garden->longitude }}">
               {{$garden->name}}
            </p>
        @endforeach
    </div>
    @endif
    @if($events)
    <div id="events-data" style="display: none;">
        @foreach($events as $index => $event)
            <p class="event" 
               data-title="{{ $event->title }}" 
               data-description="{{ $event->description }}" 
               data-date="{{ $event->date }}" 
               data-lat="{{ $event->latitude }}" 
               data-lon="{{ $event->longitude }}">
               {{$event->name}}
            </p>
        @endforeach
    </div>
    @endif

    @if($gardensWithoutLoc)
        <h2>Jardins dont la localisation n'a pas été trouvée</h2>
        <div>
            @foreach($gardensWithoutLoc as $garden)
                <p>{{ $garden['name'] }}</p>
            @endforeach
        </div>
    @endif

    @if($eventsWithoutLoc)
        <h2>Events dont la localisation n'a pas été trouvée</h2>
        <div>
            @foreach($eventsWithoutLoc as $event)
                <p>{{ $event['title'] }}</p>
                <p>{{ $event['description'] }}</p>
                <p>{{ $event['date'] }}</p>
                <p>
                    {{ $event->address['street_number'] }} 
                    {{ $event->address['street_name'] }} 
                    {{ $event->address['city'] }} 
                    {{ $event->address['postal_code'] }} 
                    {{ $event->address['country'] }}
                </p>
            @endforeach
        </div>
    @endif

    <script>
        var map;

        document.addEventListener('DOMContentLoaded', function () {
            getLocation();
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(initMapWithUserPosition, showError);
            } else {
                alert("La géolocalisation n'est pas supportée par ce navigateur.");
            }
        }

        function initMapWithUserPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // Initialiser la carte avec la position de l'utilisateur
            map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var gardenMarker = L.divIcon({
                className: 'custom-pin', // Classe CSS personnalisée
                html: '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7.5-9 13-9 13S3 17.5 3 10a9 9 0 1 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>', // SVG pour un marqueur de carte
                iconSize: [24, 24], // Taille de l'icône
                iconAnchor: [0, 0] // Point d'ancrage de l'icône
            });

            var eventMarker = L.divIcon({
                className: 'custom-pin', // Classe CSS personnalisée
                html: '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7.5-9 13-9 13S3 17.5 3 10a9 9 0 1 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>', // SVG pour un marqueur de carte
                iconSize: [24, 24], // Taille de l'icône
                iconAnchor: [25, 50] // Point d'ancrage de l'icône
            });

            var userPositionMarker = L.divIcon({
                className: 'custom-pin', // Classe CSS personnalisée
                html: '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7.5-9 13-9 13S3 17.5 3 10a9 9 0 1 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>', // SVG pour un marqueur de carte
                iconSize: [24, 24], // Taille de l'icône
                iconAnchor: [25, 50] // Point d'ancrage de l'icône
            });

            // Ajouter des marqueurs pour chaque jardin
            document.querySelectorAll('.garden').forEach(function (element) {
                var name = element.getAttribute('data-name');
                var gardenLat = parseFloat(element.getAttribute('data-lat'));
                var gardenLon = parseFloat(element.getAttribute('data-lon'));
                console.log(gardenLat, gardenLon, name);

                gardenMessage = `
                <p>Jardin</p>
                <p>` + name + `</p>
                `;

                L.marker([gardenLat, gardenLon], {icon: gardenMarker})
                 .addTo(map)
                 .bindPopup(gardenMessage)
                 .openPopup();
            });

            document.querySelectorAll('.event').forEach(function (element) {
                var title = element.getAttribute('data-title');
                var description = element.getAttribute('data-description');
                var date = element.getAttribute('data-date');
                console.log(description);
                var gardenLat = parseFloat(element.getAttribute('data-lat'));
                var gardenLon = parseFloat(element.getAttribute('data-lon'));
                console.log(gardenLat, gardenLon, name);

                eventMessage = `
                <p>Event</p>
                <p>`+ title +`</p>
                <p>` + description + `</p>
                <p>` + date + `</p>
                `;

                L.marker([gardenLat, gardenLon], {icon: eventMarker})
                 .addTo(map)
                 .bindPopup(eventMessage)
                 .openPopup();
            });

            L.marker([lat, lng], {icon: userPositionMarker})
             .addTo(map)
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
</div>

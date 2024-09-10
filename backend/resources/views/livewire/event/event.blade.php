<div class="max-w-md mx-auto mt-10">
<div class="p-2 bg-info rounded-lg text-center">
    <a class="w-full font-bold" href="{{ route('createEvent') }}">Créer un event</a>
</div>

    <h1 class="text-2xl font-bold mb-6">Liste de mes events</h1>
    @if(empty($events))
        <p>Pas d'évènement crées pour le moment</p>
    @else
    
        @foreach($events as $event)
            <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                <h2 class="text-xl mt-2">{{ $event['title'] }}</h2>
                <p class="text-gray-600 mt-2">{{ $event['description'] }}</p>
                <p class="text-gray-600 mt-2">Créé par : {{ $event['author']['firstname'] }} {{ $event['author']['lastname'] }}</p>
                <p class="text-gray-600 mt-2">Le : {{ $event['date'] }}</p>
                <p></p>

                <div>
                    <button class="mt-4 bg-info text-white py-2 px-4 rounded-lg"
                            wire:click="updateEvent({{ $event['id'] }})">
                        Modifier
                    </button>
                    <button class="mt-4 bg-error text-white py-2 px-4 rounded-lg"
                        wire:click="removeEvent({{ $event['id'] }})">
                    Supprimer
                </button>
                 </div>
            </div>
        @endforeach
    @endif
</div>

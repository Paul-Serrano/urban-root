<div class="max-w-md mx-auto mt-10">
<div class="p-2 bg-info rounded-lg text-center">
    <a class="w-full font-bold" href="{{ route('createGarden') }}">Créer un Jardin</a>
</div>

    <h1 class="text-2xl font-bold mb-6">Liste de mes jardins</h1>
    @if(empty($gardens))
        <p>Pas de Jardins ouvert pour le moment</p>
    @else
    
        @foreach($gardens as $garden)
            <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                <h2 class="text-xl font-semibold">{{ $garden['name'] }}</h2>
                <p class="text-gray-600 mt-2">Le : {{ $garden['description'] }}</p>
                <p class="text-gray-600 mt-2">Le : {{ $garden['date_created_at'] }}</p>

                <!-- Bouton pour afficher le contenu du forum -->
                 <div>
                    <button class="mt-4 bg-info text-white py-2 px-4 rounded-lg"
                            wire:click="updateGarden({{ $garden['id'] }})">
                        Modifier
                    </button>
                    <button class="mt-4 bg-error text-white py-2 px-4 rounded-lg"
                        wire:click="removeGarden({{ $garden['id'] }})">
                    Supprimer
                </button>
                 </div>
            </div>
        @endforeach
    @endif
</div>

<div class="max-w-md mx-auto mt-10">
    <div class="p-2 bg-info rounded-lg text-center">
        <a class="w-full font-bold" href="{{ route('createForum') }}">Créer un sujet de discussion</a>
    </div>

    <h1 class="text-2xl font-bold mb-6">Liste des Forums</h1>
    @if(empty($forums))
        <p>Pas de Forum ouvert pour le moment</p>
    @else
    <div>
        @foreach($forums as $forum)
            <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                <div class="flex items-center justify-between my-5">
                    <h2 class="text-2xl font-bold">{{ $forum['title'] }}</h2>
                    <div class="bg-info p-2 rounded-lg w-auto text-center">
                        <p>{{ $forum['category']['name'] }}</p>
                    </div>
                </div>
                <p class="text-gray-600 mt-2">Créé par : {{ $forum['author']['firstname'] }} {{ $forum['author']['lastname'] }}</p>
                <p class="text-gray-600 mt-2">Le : {{ $forum['date_created_at'] }}</p>

                <!-- Bouton pour afficher le contenu du forum -->
                <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg"
                        wire:click="showContent({{ $forum['id'] }})">
                    Afficher le contenu
                </button>
            </div>
        @endforeach
    </div> 
    @endif
</div>

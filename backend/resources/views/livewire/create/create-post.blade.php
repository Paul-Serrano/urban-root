<div class="max-w-md mx-auto mt-10">
    <div class="flex items-center justify-between my-5">
        <h2 class="text-2xl font-bold">{{ $forum['title'] }}</h2>
        <div class="bg-info p-2 rounded-lg w-auto text-center">
            <p>{{ $forum['category']['name'] }}</p>
        </div>
    </div>

    @if(!empty($posts))
    <div>
        @foreach($posts as $post)
            <p>{{ $post['content'] }}</p>
            <p>{{ $forum['author']['firstname'] }} {{ $post['author']['lastname'] }}</p>
            <p>{{ $post['date_created_at'] }}</p>
        @endforeach
    </div>
    @endif
    

    <x-form wire:submit.prevent="submit">
        <!-- Champs pour le post du forum -->
        <div class="mb-4">
            <label for="content" class="block text-gray-700">Votre réponse :</label>
            <x-input type="text" wire:model="content" id="content" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">Créer le Post</x-button>
    </x-form>
</div>

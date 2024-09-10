<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Créer un Forum</h1>

    <x-form wire:submit.prevent="submit">

    <x-select label="Catégories" 
                  wire:model="selectedCartegoryId"
                  :options="$categories" 
                  option-value="id" 
                  option-label="name" 
                  id="category" 
                  placeholder="Sélectionnez une Catégorie" />
    
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Titre du Forum</label>
            <x-input type="text" wire:model="title" id="title" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">Créer le Forum</x-button>
    </x-form>
</div>

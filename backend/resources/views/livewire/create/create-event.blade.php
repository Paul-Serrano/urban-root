<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Créer un Événement</h1>

    <x-form wire:submit.prevent="submit">
        <!-- Champs pour l'événement -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Titre de l'Événement</label>
            <x-input type="text" wire:model="title" id="title" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <x-input type="text" wire:model="description" id="description" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700">Date</label>
            <x-input type="date" wire:model="date" id="date" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Champs pour l'adresse -->
        <div class="mb-4">
            <label for="streetNumber" class="block text-gray-700">Numéro de Rue</label>
            <x-input type="text" wire:model="streetNumber" id="streetNumber" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('streetNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="streetName" class="block text-gray-700">Nom de Rue</label>
            <x-input type="text" wire:model="streetName" id="streetName" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('streetName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="postalCode" class="block text-gray-700">Code Postal</label>
            <x-input type="text" wire:model="postalCode" id="postalCode" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('postalCode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="city" class="block text-gray-700">Ville</label>
            <x-input type="text" wire:model="city" id="city" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="country" class="block text-gray-700">Pays</label>
            <x-input type="text" wire:model="country" id="country" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">Créer l'Événement</x-button>
    </x-form>
</div>

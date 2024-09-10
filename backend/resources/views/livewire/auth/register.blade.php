<!-- resources/views/auth/register.blade.php -->

<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Inscription</h1>

    <x-form wire:submit.prevent="register">
        @csrf
        <!-- Prénom -->
        <div class="mb-4">
            <label for="firstname" class="block text-gray-700">Prénom</label>
            <x-input type="text" wire:model="firstname" id="firstname" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('firstname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Nom -->
        <div class="mb-4">
            <label for="lastname" class="block text-gray-700">Nom</label>
            <x-input type="text" wire:model="lastname" id="lastname" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('lastname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="mail" class="block text-gray-700">Email</label>
            <x-input type="mail" wire:model="mail" id="mail" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('mail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Mot de passe</label>
            <x-input type="password" wire:model="password" id="password" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirmer le mot de passe</label>
            <x-input type="password" wire:model="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded-lg shadow-sm" />
        </div>

        <!-- Numéro de voie -->
        <div class="mb-4">
            <label for="street_number" class="block text-gray-700">Numéro</label>
            <x-input type="text" wire:model="street_number" id="street_number" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('street_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Voie -->
        <div class="mb-4">
            <label for="street_name" class="block text-gray-700">Voie</label>
            <x-input type="text" wire:model="street_name" id="street_name" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('street_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Ville -->
        <div class="mb-4">
            <label for="city" class="block text-gray-700">Ville</label>
            <x-input type="text" wire:model="city" id="city" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Code postal -->
        <div class="mb-4">
            <label for="postal_code" class="block text-gray-700">Code Postal</label>
            <x-input type="text" wire:model="postal_code" id="postal_code" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Pays -->
        <div class="mb-4">
            <label for="country" class="block text-gray-700">Pays</label>
            <x-input type="text" wire:model="country" id="country" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Bouton de soumission -->
        <x-button type="button" class="w-full bg-blue-500 text-white py-2 rounded-lg" wire:click="register">S'inscrire</x-button>
    </x-form>
</div>
<div class="max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Connexion</h1>

    <x-form wire:submit.prevent="login">
        <!-- Email -->
        <div class="mb-4">
            <label for="mail" class="block text-gray-700">Email</label>
            <x-input type="mail" wire:model="mail" id="mail" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('mail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label for="pass" class="block text-gray-700">Mot de passe</label>
            <x-input type="password" wire:model="pass" id="pass" class="w-full border-gray-300 rounded-lg shadow-sm" />
            @error('pass') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <x-button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg" wire:click="login">Se connecter</x-button>
    </x-form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('store-user-id', event => {
                const userId = event.detail.userId;
                sessionStorage.setItem('userId', userId);
                console.log('User ID stored in sessionStorage:', userId);
            });
        });
    </script>
</div>

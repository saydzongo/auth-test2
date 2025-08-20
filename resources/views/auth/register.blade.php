<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 to-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-center text-3xl font-extrabold text-indigo-700">Créer un compte</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nom et Prénom -->
                <div>
                    <x-input-label for="name" :value="__('Nom et Prénom')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Téléphone -->
                <div class="mt-4">
                    <x-input-label for="telephone" :value="__('Téléphone')" />
                    <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required autocomplete="tel" />
                    <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                </div>

                <!-- Adresse -->
                <div class="mt-4">
                    <x-input-label for="adresse" :value="__('Adresse')" />
                    <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" required autocomplete="street-address" />
                    <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
                </div>

                <!-- Mot de passe -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirmation mot de passe -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Boutons -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-indigo-600 hover:underline" href="{{ route('login') }}">
                        Déjà inscrit ?
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Enregistrer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
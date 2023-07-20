<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Information') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center my-28">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <p class="text-lg font-semibold mb-4">Name: {{ $user->name }}</p>
                    <p class="text-lg font-semibold mb-4">Email: {{ $user->email }}</p>
                    <div class="flex items-center mb-4">
                        <p class="text-lg font-semibold mr-4">2FA Secret Key:</p>
                        <p class="text-2xl font-bold">{{ $user->google2fa_secret }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

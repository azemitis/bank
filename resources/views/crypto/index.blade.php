<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cryptocurrencies') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-indigo-100 border-b border-gray-200">
                    <h4 class="text-xl font-semibold text-gray-800">Welcome to the Cryptocurrency Page</h4>
                    <p>Information, charts, and other content related to cryptocurrencies.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

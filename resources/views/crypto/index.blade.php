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
                    <h4 class="text-xl font-semibold text-gray-800">Discover Cryptocurrencies</h4>
                    <p>Explore the world of cryptocurrencies, including market data, price charts, and trends.
                        Buy or sell your cryptocurrencies.</p>

                    <!-- Display table -->
                    <table class="w-full bg-white rounded-lg overflow-hidden shadow-lg mt-6">
                        <thead class="bg-indigo-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Name</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Symbol</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Price (USD)</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Changes last 1h</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Purchase</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Sell</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cryptocurrencies as $cryptocurrency)
                            <tr class="border-b border-gray-300">
                                <td class="px-4 py-2 border">{{ $cryptocurrency['name'] }}</td>
                                <td class="px-4 py-2 border">{{ $cryptocurrency['symbol'] }}</td>
                                <td class="px-4 py-2 border">{{ $cryptocurrency['quote']['USD']['price'] }}</td>
                                <td class="px-4 py-2
                                        @if ($cryptocurrency['quote']['USD']['percent_change_1h'] < 0)
                                            text-red-500
                                        @else
                                            text-green-500
                                        @endif
                                    ">
                                    {{ $cryptocurrency['quote']['USD']['percent_change_1h'] }}
                                </td>
                                <td class="px-4 py-2 border">Purchase</td>
                                <td class="px-4 py-2 border">Sell</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

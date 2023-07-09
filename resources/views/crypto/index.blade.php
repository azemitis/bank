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
                    <h4 class="text-xl font-semibold text-gray-800">
                        Market data, price charts, and trends of main cryptocurrencies.</h4>

                    <!-- FLash messages -->
                    @if(session('success'))
                        <div id="flash-success-message" class="flash-message flash-success ml-2 -mt-2">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div id="flash-error-message" class="flash-message flash-error ml-2 -mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Owned cryptocurrencies table -->
                    <h3 class="pt-5 pl-4">Owned cryptocurrencies</h3>
                    <table class="w-full bg-white rounded-lg overflow-hidden shadow-lg mt-3">
                        <thead class="bg-indigo-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Name</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Paid</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Amount</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border text-center">Sell</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($ownedCryptocurrencies as $ownedCrypto)
                            <tr class="border-b border-gray-300">
                                <td class="px-4 py-2 border">{{ $ownedCrypto->name }}</td>
                                <td class="px-4 py-2 border">{{ $ownedCrypto->price_bought }}</td>
                                <td class="px-4 py-2 border">{{ $ownedCrypto->amount }}</td>
                                <td class="px-4 py-2 flex justify-center">
                                    <form action="{{ route('crypto.destroy', $ownedCrypto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-white border border-gray-400 hover:bg-red-600 hover:text-white text-gray-800 font-semibold py-2 px-4 rounded-full inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block align-middle -mt-1" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 6L6 18M6 6l12 12"></path>
                                            </svg>
                                            <span class="ml-2">Sell</span>
                                        </button>
                                    </form>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2">No cryptocurrencies bought.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <!-- Display all cyrrencies  table -->
                    <h3 class="pt-10 pl-4">Main cryptocurrencies on the market</h3>
                    <table class="w-full bg-white rounded-lg overflow-hidden shadow-lg mt-3">
                        <thead class="bg-indigo-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Name</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Symbol</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Price (USD)</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Changes last 1h</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Purchase</th>
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
                                <td class="border border-gray-300 px-4 py-2 items-center text-center">
                                    <form action="{{ route('crypto.create') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="cryptocurrency_id" value="{{ $cryptocurrency['id'] }}">
                                        <button type="submit" class="bg-indigo-500 text-sm hover:bg-indigo-600 text-white
                                            font-bold py-2 rounded focus:outline-none focus:shadow-outline w-32">
                                            Buy crypto
                                        </button>
                                        <input type="hidden" name="selected_currency_name"
                                               value="{{ $cryptocurrency['name'] }}">
                                        <input type="hidden" name="selected_currency_rate"
                                               value="{{ $cryptocurrency['quote']['USD']['price'] }}">
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showFlashMessage(elementId) {
            const flashMessage = document.getElementById(elementId);
            flashMessage.classList.add('show');

            setTimeout(function () {
                flashMessage.classList.remove('show');
            }, 2000);
        }

        <!-- Show success message -->
        const successMessage = document.getElementById('flash-success-message');
        if (successMessage) {
            showFlashMessage('flash-success-message', 'flash-success');
        }

        <!-- Show error message -->
        const errorMessage = document.getElementById('flash-error-message');
        if (errorMessage) {
            showFlashMessage('flash-error-message', 'flash-error');
        }

        <!-- Account delete conformation -->
        function confirmDelete(accountId) {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('flex');
            modal.classList.remove('hidden');

            modal.dataset.accountId = accountId;
        }

        function deleteAccount() {
            const modal = document.getElementById('delete-modal');
            const accountId = modal.dataset.accountId;

            document.getElementById('deleteForm-' + accountId).submit();

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function cancelDelete() {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>

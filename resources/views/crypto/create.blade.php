<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buy Cryptocurrency') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center my-20">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 w-96">
                    <form action="{{ route('crypto.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="account_id" class="block text-gray-700 text-sm font-bold mb-2">Account:</label>
                            <select name="account_id" id="account_id" class="border rounded w-full py-2 px-3
                            text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->account_number }}
                                        ({{ $account->balance }} {{ $account->currency }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Rate:</label>
                            <input type="text" name="amount" id="amount" value="{{ old('amount', '0') }}"
                                   class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none
                                    focus:shadow-outline @error('amount') border-red-500 @enderror">
                            @error('amount')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                            <input type="text" name="amount" id="amount" value="{{ old('amount', '0') }}"
                                   class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none
                                    focus:shadow-outline @error('amount') border-red-500 @enderror">
                            @error('amount')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="cost" class="block text-gray-700 text-sm font-bold mb-2">Cost:</label>
                            <input type="text" name="cost" id="cost" value="{{ old('cost', '0') }}" class="border
                                rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none
                                focus:shadow-outline @error('cost') border-red-500 @enderror" readonly>
                            @error('cost')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="cryptocurrency_id" class="block text-gray-700 text-sm font-bold mb-2">
                                Cryptocurrency:</label>
                            <select name="cryptocurrency_id" id="cryptocurrency_id" class="border rounded w-full py-2
                                px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($cryptocurrencies as $cryptocurrency)
                                    <option value="{{ $cryptocurrency['id'] }}">{{ $cryptocurrency['name'] }}
                                        ({{ $cryptocurrency['symbol'] }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2
                            mt-4 px-4 rounded focus:outline-none focus:shadow-outline">Buy Cryptocurrency</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const rateInput = document.getElementById('rate');
        const amountInput = document.getElementById('amount');
        const costInput = document.getElementById('cost');

        amountInput.addEventListener('input', () => {
            const rate = parseFloat(rateInput.value);
            const amount = parseFloat(amountInput.value);
            const cost = rate * amount;
            costInput.value = isNaN(cost) ? 0 : cost.toFixed(8);
        });
    </script>
</x-app-layout>

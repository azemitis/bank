<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buy Cryptocurrency') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center my-20">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 w-136">
                    <!-- Error messages -->
                    @if (!empty($errorMessages))
                        <div id="flash-error-message" class="flash-message flash-error mt-2">
                            <ul>
                                @foreach ($errorMessages as $error)
                                    <li>{{ $error[0] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('crypto.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="account_id" class="block text-gray-700 text-sm font-bold mb-2 w-96">
                                Account:</label>
                            <select name="account_id" id="account_id" class="border rounded w-full py-2 px-3
                            text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->account_number }}
                                        ({{ $account->balance }} {{ $account->currency }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                            <input type="text" name="amount" id="amount" value="{{ old('amount', '0') }}"
                                   class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none
                                    focus:shadow-outline
                                    @error('amount') border-red-500 @enderror">
                        </div>
                        <div class="flex items-center justify-between">
                            <label for="cryptocurrency_id" class="block text-gray-700 text-sm font-bold">Price:</label>
                            <span id="rate" class="text-gray-700 text-lg">{{ $selectedCurrencyRate }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <label for="cryptocurrency_id" class="block text-gray-700 text-sm font-bold">
                                Cryptocurrency:</label>
                            <span class="text-gray-700">{{ $selectedCurrencyName }}</span>
                            <input type="hidden" name="cryptocurrency_name" value="{{ $selectedCurrencyName }}">
                        </div>
                        <div class="flex items-center justify-between">
                            <label for="cost" class="block text-gray-700 text-sm font-bold">Cost:</label>
                            <input type="text" name="cost" id="cost" value="{{ old('cost', '0') }}" readonly
                                   class="py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                        bg-transparent border-none text-xl text-right">
                        </div>
                        <div class="flex items-center">
                            <button type="button" id="calculate"
                                    class="ml-12 bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4
                                    rounded focus:outline-none focus:shadow-outline">
                                Calculate
                            </button>
                            <button type="button" id="showConfirmationButton"
                                    class="ml-4 bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4
                                    rounded focus:outline-none focus:shadow-outline"
                                    >
                                Buy Cryptocurrency
                            </button>
                        </div>
                        <!-- 2FA security code input field -->
                        <label for="2fa_code" class="block text-gray-700 text-sm font-bold mb-2">
                        </label>
                        <input type="text" name="2fa_code" value="" id="2fa_code"
                               class="border rounded w-full py-2 px-3 text-gray-700 leading-tight
                               focus:outline-none text-center focus:shadow-outline hidden">
                    </form>
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

        <!-- Calculate price -->
        document.addEventListener('DOMContentLoaded', function () {
            const calculateButton = document.getElementById('calculate');
            const amountInput = document.getElementById('amount');
            const rateSpan = document.getElementById('rate');
            const costInput = document.getElementById('cost');

            calculateButton.addEventListener('click', function () {
                const amount = parseFloat(amountInput.value);
                const rate = parseFloat(rateSpan.textContent);
                const cost = amount * rate;

                costInput.value = cost.toFixed(2);
            });
        });
    </script>
</x-app-layout>

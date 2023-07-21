<x-app-layout>
    <!-- Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-2">
            {{ __('Welcome to the bank! ') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-indigo-100 border-b border-gray-200">

                    <!-- Accounts block -->
                    <div class="py-8">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="overflow-hidden p-6">

                                <!-- Open new accounts -->
                                <div class="mt-2 flex items-center justify-center">
                                    <a href="{{ route('accounts.create') }}" class="text-white font-semibold
                                    bg-gradient-to-r from-indigo-500 to-indigo-700 hover:from-indigo-700
                                    hover:to-indigo-900 px-6 py-3 rounded-l-lg">
                                        Open New Account
                                    </a>
                                    <span class="inline-block h-6 border-l border-white"></span>
                                    <a href="{{ route('deposits.index') }}" class="text-white font-semibold
                                    bg-indigo-700 hover:bg-indigo-500 px-6 py-3">
                                        Open Deposit Account
                                    </a>
                                    <span class="inline-block h-6 border-l border-white"></span>
                                    <a href="{{ route('crypto.index') }}" class="text-white font-semibold
                                    bg-gradient-to-r from-indigo-700 to-indigo-500 hover:from-indigo-900
                                    hover:to-indigo-700 px-6 py-3 rounded-r-lg">
                                        Buy Cryptocurrencies
                                    </a>

                                </div>
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-800 mb-4 mt-10">Your Bank Accounts</h4>
                                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                                            <thead>
                                            <tr>
                                                <th class="bg-indigo-200 border-b border-r border-white border-solid
                                                border-1 px-4 py-2 text-left text-gray-800 font-semibold">Account Number
                                                </th>
                                                <th class="bg-indigo-200 border-b border-r border-white border-solid
                                                border-1 px-4 py-2 text-left text-gray-800 font-semibold">Currency
                                                </th>
                                                <th class="bg-indigo-200 border-b border-r border-white border-solid
                                                border-1 px-4 py-2 text-left text-gray-800 font-semibold">Balance
                                                </th>
                                                <th class="bg-indigo-200 border-b border-white border-solid border-1
                                                px-4 py-2"></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($accounts as $account)
                                                <tr class="border-b border-gray-300">
                                                    <td class="border-gray-300 border-r px-4 py-2">
                                                        {{ $account->account_number }}</td>
                                                    <td class="border-gray-300 border-r px-4 py-2">
                                                        {{ $account->currency }}</td>
                                                    <td class="border-gray-300 border-r px-4 py-2">
                                                        {{ $account->balance }}</td>
                                                    <td class="border-gray-300 px-4 py-2 flex justify-center">
                                                        <form id="deleteForm-{{ $account->id }}"
                                                              action="{{ route('accounts.destroy', $account) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <!-- Delete account -->
                                                            <button type="button"
                                                                    onclick="confirmDelete({{ $account->id }})"
                                                                    class="bg-white border border-gray-400
                                                                    hover:bg-red-600 hover:text-white text-gray-800
                                                                    font-semibold py-2 px-4 rounded-full inline-flex
                                                                    items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5
                                                                inline-block align-middle -mt-1" viewBox="0 0 20 20"
                                                                     fill="none" stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M18 6L6 18M6 6l12 12"></path>
                                                                </svg>
                                                                <span class="ml-2">Close Account</span>
                                                            </button>

                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if ($accounts->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="px-4 py-2">No accounts opened.</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                <!-- Make Money Transaction section -->
                                <div class="mt-8">
                                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Transfer Money</h4>
                                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">
                                        <form action="{{ route('transactions.store') }}" method="POST"
                                              class="grid grid-cols-4 gap-4 px-6 py-2">
                                            @csrf
                                            <div class="col-span-1">
                                                <label for="sender_account"
                                                       class="block text-gray-700 text-sm font-bold mb-2">
                                                    Sender's Account:</label>
                                                <select name="sender_account" id="sender_account"
                                                        class="border rounded w-full py-2 px-3 text-gray-700
                                                            leading-tight focus:outline-none focus:shadow-outline">
                                                    @foreach ($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->account_number }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="recipient_account"
                                                       class="block text-gray-700 text-sm font-bold mb-2">
                                                    Recipient's Account:</label>
                                                <select name="recipient_account" id="recipient_account"
                                                        class="border rounded w-full py-2 px-3 text-gray-700
                                                    leading-tight focus:outline-none focus:shadow-outline">
                                                    @foreach ($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->account_number }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-1">
                                                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">
                                                    Amount:</label>
                                                <input type="text" name="amount" id="amount" value="0"
                                                       class="border rounded w-full py-2 px-3 text-gray-700
                                                    leading-tight focus:outline-none text-center focus:shadow-outline">
                                            </div>
                                            <div class="col-span-1 flex items-end justify-center">
                                                <button type="button" id="showConfirmationButton"
                                                        class="bg-indigo-500 hover:bg-indigo-600 text-white
                                                        font-semibold py-2 px-4 rounded-xl">
                                                    Transfer
                                                </button>
                                            </div>
                                            <!-- Add 2FA security code input field -->
                                            <input type="text" name="2fa_code" value="" id="2fa_code"
                                                   class="col-span-4 mt-4 border rounded w-full py-2 px-3 text-gray-700
                                                   leading-tight focus:outline-none text-center focus:shadow-outline
                                                   hidden">
                                        </form>
                                    </div>
                                </div>

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

                                    <!-- Previous Transactions section -->
                                    <div class="mt-8">
                                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Last Transaction</h4>
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
                                                <thead class="bg-indigo-200">
                                                <tr>
                                                    <th class="px-4 py-2 text-left text-gray-800 font-semibold border-r">
                                                        Amount
                                                    </th>
                                                    <th class="px-4 py-2 text-left text-gray-800 font-semibold border-r">
                                                        Sender's Account
                                                    </th>
                                                    <th class="px-4 py-2 text-left text-gray-800 font-semibold">
                                                        Recipient's Account
                                                    </th>
                                                </tr>
                                                <tbody>
                                                @if ($transactions->isNotEmpty())
                                                    @php
                                                        $lastTransaction = $transactions->last();
                                                    @endphp
                                                    <tr class="border-b border-gray-300">
                                                        <td class="px-4 py-2 border-r">{{ $lastTransaction->amount }}</td>
                                                        <td class="px-4 py-2 border-r">
                                                            @if ($lastTransaction->senderAccount)
                                                                {{ $lastTransaction->senderAccount->account_number }}
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-2 border-r">
                                                            @if ($lastTransaction->recipientAccount)
                                                                {{ $lastTransaction->recipientAccount->account_number }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="3" class="px-4 py-2">No transactions.</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('transactions.index') }}" class="underline text-indigo-500">
                                            View all your transactions
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account delete conformation modal -->
    <div id="delete-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-1/3 rounded-lg shadow-lg p-8">
            <p class="text-gray-800 text-lg mb-4">Are you sure you want to delete this account?</p>
            <div class="flex justify-end">
                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg mr-2"
                        onclick="deleteAccount()">Close account
                </button>
                <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg"
                        onclick="cancelDelete()">Cancel
                </button>
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

        // Function to handle the click event of the "Transfer" button
        document.getElementById('showConfirmationButton').addEventListener('click', function (event) {
            event.preventDefault();

            const securityCode = prompt('Please enter your security code:');
            if (securityCode !== null && securityCode.trim() !== '') {
                document.getElementById('2fa_code').value = securityCode;
                event.target.closest('form').submit();
            }
        });
    </script>

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to the bank!') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-indigo-100 border-b border-gray-200">

                    <!-- Display Deposit Accounts -->
                    <div class="py-8">
                        <div class="container mx-auto px-20">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">Current Deposit Accounts</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full bg-white rounded-lg overflow-hidden shadow-lg">
                                    <thead class="bg-indigo-200">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">
                                            Account Number
                                        </th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Currency</th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Term</th>
                                        <th class="pl-4 py-2 text-left text-gray-800 font-semibold border">
                                            Amount Deposited
                                        </th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Amount Due
                                        </th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Rate</th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($depositAccounts as $account)
                                        <tr class="border-b border-gray-300">
                                            <td class="px-4 py-2 border">{{ $account->account_number }}</td>
                                            <td class="px-4 py-2 border">{{ $account->currency }}</td>
                                            <td class="px-4 py-2 border">{{ $account->term }} months</td>
                                            <td class="px-4 py-2 border">{{ $account->amount }}</td>
                                            <td class="px-4 py-2 border">{{ $account->amount_with_interests }}</td>
                                            <td class="px-4 py-2 border">{{ $account->rate }}%</td>
                                            <td class="px-4 py-2 border">
                                                <!-- Withdraw deposit account -->
                                                <button type="button" onclick="confirmDelete({{ $account->id }})"
                                                        class="bg-white border border-gray-400 hover:bg-red-600
                                                        hover:text-white text-gray-800 font-semibold py-2 px-4
                                                        rounded-full inline-flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block
                                                    align-middle -mt-1" viewBox="0 0 20 20"
                                                         fill="none" stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M18 6L6 18M6 6l12 12"></path>
                                                    </svg>
                                                    <span class="ml-2">Withdraw</span>
                                                </button>
                                                <form id="deleteForm-{{ $account->id }}"
                                                      action="{{ route('deposits.withdraw', $account) }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($depositAccounts->isEmpty())
                                        <tr>
                                            <td colspan="4" class="px-4 py-2 text-left">No deposit accounts opened.</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Display Closed Deposit Accounts -->
                        <div class="container mx-auto px-20 mt-10">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">Closed Deposit Accounts</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full bg-white rounded-lg overflow-hidden shadow-lg">
                                    <thead class="bg-indigo-200">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">
                                            Account Number
                                        </th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Currency</th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Term</th>
                                        <th class="pl-4 py-2 text-left text-gray-800 font-semibold border">
                                            Amount Deposited
                                        </th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Amount Due
                                        </th>
                                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Rate</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($closedDepositAccounts as $account)
                                        <tr class="border-b border-gray-300">
                                            <td class="px-4 py-2 border">{{ $account->account_number }}</td>
                                            <td class="px-4 py-2 border">{{ $account->currency }}</td>
                                            <td class="px-4 py-2 border">{{ $account->term }} months</td>
                                            <td class="px-4 py-2 border">{{ $account->amount }}</td>
                                            <td class="px-4 py-2 border">{{ $account->amount_with_interests }}</td>
                                            <td class="px-4 py-2 border">{{ $account->rate }}%</td>
                                        </tr>
                                    @endforeach
                                    @if ($closedDepositAccounts->isEmpty())
                                        <tr>
                                            <td colspan="4" class="px-4 py-2 text-left">No closed deposit accounts.</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Open new Deposit Account -->
                        <div class="mt-8">
                            <form action="{{ route('deposits.store') }}" method="POST">
                                @csrf
                                <div class="container mx-auto px-20">
                                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Open New Deposit Account</h4>
                                    <table class="w-full bg-white rounded-lg overflow-hidden shadow-lg">
                                        <thead class="bg-indigo-200">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">From
                                                Account:
                                            </th>
                                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Available
                                                Balance:
                                            </th>
                                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">
                                                Currency:
                                            </th>
                                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Deposit
                                                Term:
                                            </th>
                                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Amount:
                                            </th>
                                            <th class="px-4 py-2"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="border border-gray-300 px-4 py-2">
                                                <!--suppress HtmlFormInputWithoutLabel -->
                                                <select name="from_account" id="from_account"
                                                        class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                                        focus:shadow-outline w-60">
                                                    @foreach ($accounts as $account)
                                                        <option
                                                            value="{{ $account->id }}">{{ $account->account_number }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td class="border border-gray-300 px-4 py-2">
                                                <!--suppress HtmlFormInputWithoutLabel -->
                                                <input type="text" readonly id="available_balance"
                                                       value="{{ $accounts[0]->balance ?? '' }}"
                                                       class="border rounded py-2 px-3 text-gray-700 bg-gray-100
                                                       focus:outline-none focus:shadow-outline w-28"
                                                       onchange="updateAccountBalance()">
                                            </td>

                                            <td class="border border-gray-300 px-4 py-2">
                                                <!--suppress HtmlFormInputWithoutLabel -->
                                                <select name="currency" id="currency"
                                                        class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                                        focus:shadow-outline w-20">
                                                    <option value="EUR">EUR</option>
                                                    <option value="USD">USD</option>
                                                    <option value="GBP">GBP</option>
                                                </select>
                                            </td>

                                            <td class="border border-gray-300 px-4 py-2">
                                                <!--suppress HtmlFormInputWithoutLabel -->
                                                <select name="term" id="term"
                                                        class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                                        focus:shadow-outline  w-28">
                                                    @foreach ($terms as $term)
                                                        <option value="{{ $term }}">{{ $term }} months</option>
                                                    @endforeach
                                                </select>
                                                <span id="rate" class="text-gray-700 text-sm ml-2"></span>
                                            </td>

                                            <td class="border border-gray-300 px-4 py-2">
                                                <!--suppress HtmlFormInputWithoutLabel -->
                                                <input type="text" name="amount" id="amount"
                                                       class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                                       focus:shadow-outline w-24">
                                            </td>

                                            <td class="border border-gray-300 px-4 py-2">
                                                <button type="submit" id="showConfirmationButton"
                                                        class="bg-indigo-500 text-sm hover:bg-indigo-600 text-white
                                                        font-bold py-2 rounded focus:outline-none focus:shadow-outline w-32">
                                                    Open Deposit Account
                                                </button>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- 2FA security code input field -->
                                    <label for="2fa_code" class="block text-gray-700 text-sm font-bold mb-2">
                                    </label>
                                    <input type="text" name="2fa_code" value="" id="2fa_code"
                                           class="border rounded w-full py-2 px-3 text-gray-700 leading-tight
                                                   focus:outline-none text-center focus:shadow-outline hidden">
                                </div>
                            </form>
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

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Account withdraw conformation modal -->
    <div id="delete-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-sky-900 w-1/3 rounded-lg shadow-lg p-8">
            <p class="text-white text-lg mb-4">Are you sure you want to withdraw from money from this account?</p>
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

        <!-- Update Account Balance -->
        const accountDropdown = document.getElementById('from_account');
        const availableBalanceField = document.getElementById('available_balance');

        function updateAccountBalance() {
            const selectedAccountId = accountDropdown.value;
            const selectedAccount = {!! json_encode($accounts) !!}
                .find(account => account.id === parseInt(selectedAccountId));
            availableBalanceField.value = selectedAccount.balance;
        }

        <!-- Event listener for account dropdown change -->
        accountDropdown.addEventListener('change', updateAccountBalance);

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

        <!-- Update account balance on page load -->
        window.addEventListener('DOMContentLoaded', updateAccountBalance);

        <!-- Account withrdraw conformation -->
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

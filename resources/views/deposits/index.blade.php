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
                                                <form action="{{ route('deposits.withdraw', $account) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-gray-400 hover:bg-red-600
                                                    text-white font-bold py-2 px-4 rounded focus:outline-none
                                                    focus:shadow-outline">Withdraw
                                                    </button>
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
                                            </td>
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
                                                <input type="text" readonly id="available_balance"
                                                       value="{{ $accounts[0]->balance }}"
                                                       class="border rounded py-2 px-3 text-gray-700 bg-gray-100
                                                       focus:outline-none focus:shadow-outline w-28"
                                                       onchange="updateAccountBalance()">
                                            </td>

                                            <td class="border border-gray-300 px-4 py-2">
                                                <select name="currency" id="currency"
                                                        class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                                        focus:shadow-outline w-20">
                                                    <option value="EUR">EUR</option>
                                                    <option value="USD">USD</option>
                                                    <option value="GBP">GBP</option>
                                                </select>
                                            </td>

                                            <td class="border border-gray-300 px-4 py-2">
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
                                                <input type="text" name="amount" id="amount"
                                                       class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                                       focus:shadow-outline w-24">
                                            </td>

                                            <td class="border border-gray-300 px-4 py-2">
                                                <button type="submit"
                                                        class="bg-indigo-500 text-sm hover:bg-indigo-600 text-white
                                                        font-bold py-2 rounded focus:outline-none focus:shadow-outline w-32">
                                                    Open Deposit Account
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
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

    <script>
        function showFlashMessage(elementId, type) {
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
    </script>

</x-app-layout>

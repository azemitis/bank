<x-app-layout>
    <!-- Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-2">
            {{ __('Welcome to the bank!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-indigo-100 border-b border-gray-200">
                    {{--                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Welcome to Bank!</h3>--}}
                    {{--                    <p class="text-gray-600">Here you can see all your accounts and money transfers. </p>--}}

                    <!-- Accounts section -->
                    <div class="mt-4">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Your Bank Accounts</h4>
                        <table class="min-w-full  border border-gray-200">
                            <thead>
                            <tr>
                                <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2
                                text-left text-gray-800 font-semibold">Account Number
                                </th>
                                <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2
                                text-left text-gray-800 font-semibold">Currency
                                </th>
                                <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2
                                text-left text-gray-800 font-semibold">Balance
                                </th>
                                <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($accounts as $account)
                                <tr class="border-b border-gray-300">
                                    <td class="border-gray-300 border-r px-4 py-2">{{ $account->account_number }}</td>
                                    <td class="border-gray-300 border-r px-4 py-2">{{ $account->currency }}</td>
                                    <td class="border-gray-300 border-r px-4 py-2">{{ $account->balance }}</td>
                                    <td class="border-gray-300 px-4 py-2 flex justify-center">
                                        <form action="{{ route('accounts.destroy', $account) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-gray-400 hover:bg-red-600 text-white font-semibold
                                                    py-2 px-4 rounded-full inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5 inline-block align-middle -mt-1"
                                                     viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M18 6L6 18M6 6l12 12"></path>
                                                </svg>
                                                <span class="ml-2">Close Account</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Open new account -->
                    <div class="mt-8 flex items-center">
                        <a href="{{ route('accounts.create') }}"
                           class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2
                           px-4 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block align-middle -mt-1"
                                 viewBox="0 0 20 20" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span class="ml-2">Open New Account</span>
                        </a>
                    </div>

                    <!-- Make Money Transactions section -->
                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Transfer Money</h4>

                        <form action="{{ route('transactions.store') }}" method="POST" class="flex flex-wrap relative">
                            @csrf
                            <div class="mb-4 flex-1 mx-2">
                                <label for="sender_account" class="block text-gray-700 text-sm font-bold mb-2">
                                    Sender's Account:</label>
                                <select name="sender_account" id="sender_account" class="border rounded w-full py-2 px-3
            text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->account_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4 flex-1">
                                <label for="recipient_account" class="block text-gray-700 text-sm font-bold mb-2">
                                    Recipient's Account:</label>
                                <select name="recipient_account" id="recipient_account"
                                        class="border rounded w-full py-2 px-3
            text-gray-700 leading-tight focus:outline-none
            focus:shadow-outline">
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->account_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 flex-1 mx-1">
                                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                                <input type="text" name="amount" id="amount" value="0" class="border rounded w-20 px-3
            text-gray-700 leading-tight focus:outline-none
            focus:shadow-outline">
                            </div>
                            <div class="flex justify-start flex-1 mt-6">
                                <div class="flex-shrink-0">
                                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white
                                    font-semibold py-2 px-4 rounded-full inline-flex items-center">Transfer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

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

                    <!-- Previous transactions section -->
                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Your Transactions</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2
                                    text-left text-gray-800 font-semibold">Amount
                                    </th>
                                    <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2
                                    text-left text-gray-800 font-semibold">Sender's Account
                                    </th>
                                    <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2
                                    text-left text-gray-800 font-semibold">Recipient's Account
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr class="border-b border-gray-300">
                                        <td class="border-gray-300 border-r px-4 py-2">
                                            {{ $transaction->amount }}</td>
                                        <td class="border-gray-300 border-r px-4 py-2">
                                            @if ($transaction->senderAccount)
                                                {{ $transaction->senderAccount->account_number }}
                                            @endif
                                        </td>
                                        <td class="border-gray-300 px-4 py-2">
                                            @if ($transaction->recipientAccount)
                                                {{ $transaction->recipientAccount->account_number }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .flash-message {
            position: absolute;
            padding: 3px 35px;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .flash-success {
            background-color: #008000;
            color: #ffffff;
        }

        .flash-error {
            background-color: #ff0000;
            color: #ffffff;
        }

        .flash-message.show {
            opacity: 1;
        }

        @keyframes flash {
            0% {
                background-color: inherit;
            }
            50% {
                background-color: #00ff00;
            }
            100% {
                background-color: inherit;
            }
        }
    </style>

    <script>
        function showFlashMessage(elementId, type) {
            const flashMessage = document.getElementById(elementId);
            flashMessage.classList.add('show');

            setTimeout(function () {
                flashMessage.classList.remove('show');
            }, 3000);
        }

        // Show success message
        const successMessage = document.getElementById('flash-success-message');
        if (successMessage) {
            showFlashMessage('flash-success-message', 'flash-success');
        }

        // Show error message
        const errorMessage = document.getElementById('flash-error-message');
        if (errorMessage) {
            showFlashMessage('flash-error-message', 'flash-error');
        }
    </script>

</x-app-layout>

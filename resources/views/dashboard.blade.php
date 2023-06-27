<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-2">
            {{ __('Your bank page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-indigo-100 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Welcome to Bank!</h3>
                    <p class="text-gray-600">Here you can see your accounts and money transfers. </p>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Your Bank Accounts</h4>
                        <table class="min-w-full  border border-gray-200">
                            <thead>
                            <tr>
                                <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2 text-left text-gray-800 font-semibold">Account Number</th>
                                <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2 text-left text-gray-800 font-semibold">Currency</th>
                                <th class="bg-indigo-200 border-b-2 border-gray-300 px-4 py-2 text-left text-gray-800 font-semibold">Balance</th>
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

                    <div class="mt-8 flex items-center">
                        <a href="{{ route('accounts.create') }}"
                           class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block align-middle -mt-1"
                                 viewBox="0 0 20 20" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span class="ml-2">Open New Account</span>
                        </a>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Your Transactions</h4>

                        <ul class="space-y-4">
                            @foreach ($transactions as $transaction)
                                <li>
                                    <p>Amount: {{ $transaction->amount }}</p>
                                    <p>Sender Account: {{ $transaction->senderAccount->account_number }}</p>
                                    <p>Recipient Account: {{ $transaction->recipientAccount->account_number }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

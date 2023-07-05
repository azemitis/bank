<x-app-layout>
    <!-- Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-2">
            {{ __('Welcome to the bank!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-indigo-100 border-b border-gray-200">

                    <!-- Previous transactions section -->
                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Your Transactions</h4>
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="shadow-md sm:rounded-lg">
                                <table class="min-w-full bg-white table-auto">
                                    <thead>
                                    <tr>
                                        <th class="bg-indigo-200 border-b border-r border-white border-solid border-1
                                        px-4 py-2 text-left text-gray-800 font-semibold">Amount
                                        </th>
                                        <th class="bg-indigo-200 border-b border-r border-white border-solid border-1
                                        px-4 py-2 text-left text-gray-800 font-semibold">Sender's Account
                                        </th>
                                        <th class="bg-indigo-200 border-b border-gray-300 px-4 py-2 text-left
                                        text-gray-800 font-semibold">Recipient's Account
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr class="border-b border-gray-300">
                                            <td class="border-gray-300 border-r px-4 py-2">{{ $transaction->amount }}</td>
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
    </div>

</x-app-layout>

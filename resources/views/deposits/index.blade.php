<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Deposit Accounts') }}
        </h2>
    </x-slot>

    <!-- Display Deposit Accounts -->
    <div class="mt-20">
        <div class="container mx-auto px-20">
            <h4 class="text-xl font-semibold text-gray-800 mb-4">Current Deposit Accounts</h4>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg overflow-hidden shadow-lg">
                    <thead class="bg-indigo-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Account Number</th>
                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Currency</th>
                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Term</th>
                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Amount Due</th>
                        <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($depositAccounts as $account)
                        <tr class="border-b border-gray-300">
                            <td class="px-4 py-2 border">{{ $account->account_number }}</td>
                            <td class="px-4 py-2 border">{{ $account->currency }}</td>
                            <td class="px-4 py-2 border">{{ $account->term }} months</td>
                            <td class="px-4 py-2 border">{{ $account->amount }}</td>
                            <td class="px-4 py-2 border">{{ $account->rate }}%</td>
                        </tr>
                    @endforeach
                    @if ($depositAccounts->isEmpty())
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center">No deposit accounts found.</td>
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
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">From Account:</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Currency:</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Deposit Term:</th>
                            <th class="px-4 py-2 text-left text-gray-800 font-semibold border">Amount:</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">
                                <select name="from_account" id="from_account"
                                        class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                            focus:shadow-outline w-64">
                                    @foreach ($accounts as $account)
                                        <option
                                            value="{{ $account->id }}">{{ $account->account_number }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <select name="currency" id="currency"
                                        class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                            focus:shadow-outline  w-20">
                                    <option value="EUR">EUR</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                </select>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <select name="term" id="term"
                                        class="border rounded py-2 px-3 text-gray-700 focus:outline-none
                                            focus:shadow-outline  w-32">
                                    @foreach ($terms as $term)
                                        <option value="{{ $term }}">{{ $term }} months</option>
                                    @endforeach
                                </select>
                                <span id="rate" class="text-gray-700 text-sm ml-2"></span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" name="amount" id="amount"
                                       class="border rounded py-2 px-3 text-gray-700
                                       focus:outline-none focus:shadow-outline w-32"
                                       placeholder="Enter amount">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <button type="submit"
                                        class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4
                                        rounded focus:outline-none focus:shadow-outline">
                                    Open Deposit Account
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

    </div>

</x-app-layout>

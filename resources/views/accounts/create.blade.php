<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Account') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center mt-20">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('accounts.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="currency" class="block text-gray-700 text-sm font-bold mb-2">Currency:</label>
                            <select name="currency" id="currency" class="border rounded w-full py-2 px-3 text-gray-700
                            leading-tight focus:outline-none focus:shadow-outline">
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                                <option value="GBP">GBP</option>
                            </select>
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
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2
                            px-4 rounded focus:outline-none focus:shadow-outline">Create Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

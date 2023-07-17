<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Account') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center my-40">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Success message -->
                    @if (session('success'))
                        <div id="flash-success-message" class="flash-message flash-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Error message -->
                    @if ($errors->any())
                        <div id="flash-error-message" class="flash-message flash-error mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
    </script>
</x-app-layout>

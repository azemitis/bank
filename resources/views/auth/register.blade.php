<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="max-w-md w-full px-6 py-8 bg-white shadow-md rounded-lg">
            <div class="flex justify-center">
            </div>

            <h2 class="mt-6 text-3xl font-semibold text-center text-gray-800">Register</h2>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mt-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}" class="mt-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Name</label>
                    <input id="name" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" :value="old('name')" required autofocus>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-600">Email</label>
                    <input id="email" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Password</label>
                    <input id="password" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="new-password">
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-600">Confirm Password</label>
                    <input id="password_confirmation" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password_confirmation" required>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">
                        Register
                    </button>
                </div>
            </form>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-indigo-600 hover:text-indigo-500" href="{{ route('login') }}">
                    Already registered?
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

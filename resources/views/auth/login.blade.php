<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <div class="max-w-md w-full px-6 py-8 bg-white shadow-md rounded-lg">

            <h2 class="mt-6 text-3xl font-semibold text-center text-gray-800">Log In</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mt-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mt-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}" class="mt-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-600">Email</label>
                    <input id="email" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Password</label>
                    <input id="password" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="current-password">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mt-4">
                    <input id="remember_me" type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Security Code -->
                <div class="mt-4">
                    <label for="security_code" class="block mb-2 text-sm font-medium text-gray-600">Security Code</label>
                    <input id="security_code" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" type="text" name="security_code" required>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">
                        Log in
                    </button>
                </div>
            </form>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>

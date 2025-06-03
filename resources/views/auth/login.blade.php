<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Make sure Tailwind is loaded -->
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Admin Login</h2>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                <input type="email" name="email" id="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-500">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-500">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
{{--                <label class="flex items-center space-x-2">--}}
{{--                    <input type="checkbox" name="remember" class="form-checkbox text-accent-600">--}}
{{--                    <span class="text-sm text-gray-600">Remember me</span>--}}
{{--                </label>--}}
                <a href="#" class="text-sm text-accent-600 hover:underline">Forgot password?</a>
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                        class="w-full bg-accent-600 hover:bg-accent-700 font-semibold py-2 px-4 rounded-lg transition">
                    Sign In
                </button>
            </div>
        </form>
    </div>

</body>
</html>

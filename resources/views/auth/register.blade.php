<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white rounded-xl shadow-md p-8 space-y-6">
    <h2 class="text-2xl font-bold text-center text-gray-800">Create an account</h2>

    <form id="registerForm" method="post" action="{{route('register')}}" class="space-y-5">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" id="name" name="name" required
                   class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-accent-500" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" id="email" name="email" required
                   class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-accent-500" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required
                   class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-accent-500" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                   class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-accent-500" />
        </div>

        <button type="submit"
                class="w-full py-2 px-4 bg-accent-600 hover:bg-accent-700  rounded-md font-semibold transition">
            Register
        </button>
    </form>

    <p class="text-sm text-center text-gray-600">
        Already have an account?
        <a href="/login" class="text-accent-600 hover:underline">Log in</a>
    </p>
</div>

</body>
</html>

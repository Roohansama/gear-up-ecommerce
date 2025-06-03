<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Gear Up Ecommerce')</title>

    {{-- Load compiled CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
@include('layouts.header')

<main class="flex h-screen">
    @include('layouts.sidebar')
    @yield('content')
</main>

@include('layouts.footer')
</body>
</html>

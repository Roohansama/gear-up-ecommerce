<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', 'Gear Up Ecommerce')</title>

    {{-- Load compiled CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" text-gray-900">
@include('layouts.store.header')

<main class="flex h-screen overflow-hidden font-roboto mb-5">
    @yield('content')
</main>

@include('layouts.store.footer')
</body>
@stack('scripts')
</html>

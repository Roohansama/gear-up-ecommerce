<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', 'Gear Up Ecommerce')</title>

    {{-- Load compiled CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
</head>
<body class=" text-gray-900">
@include('layouts.admin.header')

<main class="flex h-screen">
    @include('layouts.admin.sidebar')
    @yield('content')
</main>

@include('layouts.admin.footer')
</body>
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@stack('scripts')
</html>

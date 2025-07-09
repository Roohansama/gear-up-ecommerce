<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', 'Gear Up Ecommerce')</title>

    {{-- Load compiled CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/echo.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="text-gray-900 font-light ">
@include('layouts.store.header')

<main class="flex min-h-[84vh] mb-5" id="main">
    @yield('content')
</main>

@include('layouts.store.footer')
</body>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
</script>

</html>

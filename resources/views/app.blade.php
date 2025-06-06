<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Enterprise Opt') }}</title>
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('img/icons/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased h-full min-h-screen flex justify-center">
    <div id="app" class="bg-neutral-50"></div>
</body>

</html>

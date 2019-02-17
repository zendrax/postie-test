<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app" class="min-h-screen">
            <acme-menu></acme-menu>
            <router-view class="container mx-auto"></router-view>
            <acme-notifications></acme-notifications>
        </div>
        <script>
            window.instagram = {!! $instagram !!}
        </script>
        <script src="/js/app.js"></script>
    </body>
</html>

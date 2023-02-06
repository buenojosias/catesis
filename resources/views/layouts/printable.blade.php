<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('build/assets/printable-01eb661f.css') }}">
    {{-- @vite(['resources/css/printable.css']) --}}
    <title>{{ $title }}</title>
</head>
<body>
    @yield('content')
</body>

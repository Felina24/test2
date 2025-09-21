<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/default.css') }}" />
    @yield('css')
    <title>mogitate</title>
</head>
<body>
    <header class="header">
    <a href="{{ route('products.index') }}">mogitate</a>
    </header>
    @yield('content')
</body>
</html>
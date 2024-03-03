<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('meta_description')">
    <link rel="shortcut icon" href="{{ asset('favicon/logoFavicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styleSASS.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <header>
        <x-header/>
    </header>
    
    @yield('content')

    <footer>
        <x-footer/>
    </footer>

    @yield('scripts')
    <script src="{{ asset('js/header.js') }}"></script>
</body>


</html>

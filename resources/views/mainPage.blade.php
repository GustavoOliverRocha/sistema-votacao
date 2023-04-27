<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('enquete.components.head')
</head>
    <body class="cm-no-transition cm-1-navbar antialiased">
            @include('enquete.components.navbar')
            @yield('content')
    </body>
</html>

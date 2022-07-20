<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema Votação</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .btn{
                color: #2E4DC9;
            }
            .btn:hover{
                cursor: pointer;
                opacity: 80%;
            }
        </style>
    </head>
    <body class="antialiased">
            @yield('content')
    </body>
</html>

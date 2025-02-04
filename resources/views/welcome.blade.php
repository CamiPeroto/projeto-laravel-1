<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Camila</title>

    </head>
    <body>
        <div>
            <h1>Bem-Vindo ao Laravel 11!</h1>
            <a href="{{route('courses.index')}}">Listar</a>
            {{-- <p>Data atual: {{\Carbon\Carbon::now()->format('d/m/Y H:i:s')}}</p> --}}
            {{-- escrevendo a data atual na tela  --}}

        </div>
    </body>
</html>

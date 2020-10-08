<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página de usuário</title>
</head>
<body>
    @auth
        <h4>Você está logado</h4>
        <p>{{Auth::user()->id}}</p>
        <p>{{Auth::user()->name}}</p>
        <p>{{Auth::user()->email}}</p>
    @endauth
    @guest
        <h4>Você não está logado</h4>
    @endguest
</body>
</html>

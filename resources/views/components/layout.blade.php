<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>{{ $title }}</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('books.index') }}">Livros</a>
        <a class="navbar-brand mr-auto" href="{{ route('reservations.index') }}">Reservas</a>

        <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-secondary" type="submit">Sair</button>
        </form>
    </nav>
    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('message.success'))
        <div class="alert alert-success mt-3">
            {{ session('message.success') }}
        </div>
        @endif

        <h1>{{ $title }}</h1>

        {{ $slot }}
    </div>
</body>

</html>
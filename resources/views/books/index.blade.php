<x-layout title="Livros">
    @if (auth()->user()->role == 'admin')
    <a class="btn btn-dark mb-3" href="{{ route('books.create') }}">Adicionar</a>
    @endif

    <form action="{{ route('books.index') }}" method="GET">
        <div class="form-group row">
            <div class="col-md-5">
                <input type="text" id="title" name="title" class="form-control" placeholder="Titulo" value="{{ request()->input('title') }}">
            </div>
            <div class="col-md-5">
                <input type="text" id="author" name="author" class="form-control" placeholder="Autor" value="{{ request()->input('author') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="form-control btn btn-primary">Pesquisar</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->quantity }} / {{ $book->quantity + $book->reservations()->count() }}</td>
                <td>
                    <div class="d-flex">
                        <form action="{{ route('books.reserve', $book->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-light btn-sm mr-2">
                                reservar
                            </button>
                        </form>

                        @if (auth()->user()->role == 'admin')
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm mr-2">
                            editar
                        </a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm mr-2">
                                excluir
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
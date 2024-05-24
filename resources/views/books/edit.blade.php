<x-layout title="Editar Livro">
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <div class="col-md-5">
                <label class="form-label" for="title">Titulo:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $book->title }}" autofocus>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="author">Autor:</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ $book->author }}">
            </div>
            <div class="col-md-2">
                <label class="form-label" for="isbn">Isbn:</label>
                <input type="text" id="isbn" name="isbn" class="form-control" value="{{ $book->isbn }}">
            </div>
            <div class="col-md-1">
                <label class="form-label" for="quantity">Qtd:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $book->quantity }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label class="form-label" for="description">Descrição:</label>
                <textarea name="description" id="description" class="form-control">{{ $book->description }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Alterar</button>
    </form>
</x-layout>
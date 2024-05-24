<x-layout title="Novo Livro">
    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="form-group row">
            <div class="col-md-5">
                <label class="form-label" for="title">Titulo:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" autofocus>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="author">Autor:</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ old('author') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label" for="isbn">Isbn:</label>
                <input type="text" id="isbn" name="isbn" class="form-control" value="{{ old('isbn') }}">
            </div>
            <div class="col-md-1">
                <label class="form-label" for="quantity">Qtd:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <label class="form-label" for="description">Descrição:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>
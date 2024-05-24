<x-layout title="Livros reservados">

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->book->title }}</td>
                <td>{{ $reservation->book->author }}</td>
                <td>
                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary btn-sm mr-2">
                            devolver
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
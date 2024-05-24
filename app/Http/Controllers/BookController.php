<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->has('title')) {
            $title = $request->title;
            $books->where('title', 'like', "%$title%");
        }

        if ($request->has('author')) {
            $author = $request->author;
            $books->where('author', 'like', "%$author%");
        }

        $books = $books->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'nullable',
            'isbn' => 'required|max:13|unique:books',
            'quantity' => 'required|min:0',
        ]);

        Book::create($validatedData);

        return redirect()->route('books.index')->with('message.success', 'Livro criado com sucesso.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'description' => 'nullable',
            'isbn' => 'required|max:13|unique:books,isbn,' . $book->id,
            'quantity' => 'required|min:0',
        ]);

        $book->update($validatedData);

        return redirect()->route('books.index')->with('message.success', 'Livro alterado com sucesso.');
    }

    public function destroy(Book $book)
    {
        if ($book->reservations()->exists()) {
            return redirect()->back()->withErrors("Não é possível excluir a série '{$book->title}' pois existem reservas associadas a ela.");
        }

        $book->delete();

        return redirect()->route('books.index')->with('message.success', 'Livro excluido com sucesso.');
    }

    public function reserve(Book $book)
    {
        if ($book->quantity == 0) {
            return redirect()->back()->withErrors('Livro não disponível para reserva.');
        }

        $existingReservation = Reservation::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($existingReservation) {
            return redirect()->back()->withErrors('Você já reservou este livro.');
        }

        $book->quantity -= 1;
        $book->save();

        Reservation::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
        ]);

        return redirect()->route('books.index')->with('message.success', 'Livro reservado com sucesso.');
    }
}

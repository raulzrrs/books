<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = $user->reservations;

        return view('reservations.index', compact('reservations'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->book->increment('quantity');
        $reservation->delete();

        return redirect()->route('reservations.index')->with('message.success', 'Livro devolvido com sucesso.');
    }
}

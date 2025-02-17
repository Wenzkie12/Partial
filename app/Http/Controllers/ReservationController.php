<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Book;
use App\Models\ToReturnList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ApplyPenaltyJob;
use App\Models\UserBookTracking;

class ReservationController extends Controller
{
    
    public function store(Request $request, $bookId)
    {
        $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
        ]);

        $book = Book::findOrFail($bookId);

        if ($book->quantity < 1) {
            return redirect()->back()->with('error', 'Book is not available for reservation.');
        }

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'reservation_date' => $request->reservation_date,
        ]);

     
        UserBookTracking::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'pending',
            'reservation_date' => $request->reservation_date,
        ]);

        $book->decrement('quantity');

        return redirect()->back()->with('success', 'Book reserved successfully.');
    }


    public function claim($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation || $reservation->claimed_at) {
            return redirect()->route('staff.reservation-list')->with('error', 'Reservation not found or already claimed.');
        }

        $toReturn = ToReturnList::create([
            'user_id' => $reservation->user_id,
            'book_id' => $reservation->book_id,
            'claimed_at' => now(),
        ]);

  
        ApplyPenaltyJob::dispatch($toReturn)->delay(now()->addMinute());

  
        UserBookTracking::where('user_id', $reservation->user_id)
            ->where('book_id', $reservation->book_id)
            ->update([
                'status' => 'claimed',
                'claimed_at' => now(),
            ]);

        $reservation->delete();

        return redirect()->route('staff.to-return-list')->with('success', 'Book claimed successfully.');
    }


    public function removeExpiredReservations()
    {
        $expiredReservations = Reservation::where('reservation_date', '<', Carbon::today())->get();

        foreach ($expiredReservations as $reservation) {

            $reservation->book->increment('quantity');

  
            UserBookTracking::where('user_id', $reservation->user_id)
                ->where('book_id', $reservation->book_id)
                ->delete();

            $reservation->delete();
        }

        return 'Expired reservations removed.';
    }

 
    public function returnBook($id)
    {
        $toReturn = ToReturnList::find($id);

        if (!$toReturn || $toReturn->returned_at) {
            return redirect()->route('staff.to-return-list')->with('error', 'Book already returned.');
        }

        if ($toReturn->book) {
            $toReturn->book->increment('quantity');
        }

        UserBookTracking::where('user_id', $toReturn->user_id)
            ->where('book_id', $toReturn->book_id)
            ->update([
                'status' => 'returned',
                'returned_at' => now(),
            ]);

        $toReturn->delete();

        return redirect()->route('staff.to-return-list')->with('success', 'Book returned successfully.');
    }

    // Show user tracking table
    public function userTracking()
    {
        $trackingRecords = UserBookTracking::where('user_id', Auth::id())->get();
        return view('user.tracking', compact('trackingRecords'));
    }
}

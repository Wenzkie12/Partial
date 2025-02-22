<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ToReturnList;
use App\Models\User;

class StaffController extends Controller
{
    public function reservationList()
    {
        $reservations = Reservation::with(['user', 'book'])
            ->whereHas('userBookTracking', function ($query) {
                $query->where('status', '!=', 'canceled'); // Exclude canceled reservations
            })
            ->get();
    
        if ($reservations->isEmpty()) {
            return back()->with('error', 'No reservations found.');
        }
    
        return view('staff.reservation-list', compact('reservations'));
    }
    

    public function toReturnList()
{
    $toReturnItems = ToReturnList::with(['user', 'book'])->get();

    return view('staff.to-return-list', compact('toReturnItems'));
}

public function usersWithPenalties()
{
    $users = User::where('penalty', '>', 0)->get();
    return view('staff.payment-section', compact('users'));
}


}

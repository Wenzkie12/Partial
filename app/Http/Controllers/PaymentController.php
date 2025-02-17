<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
  
    public function index()
    {
        $users = User::where('penalty', '>', 0)->get();
        return view('staff.payment-section', compact('users'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'payment_amount' => 'required|numeric|min:1',
        ]);

        $user = User::findOrFail($userId);
        $amountToPay = $request->payment_amount;

        if ($amountToPay > $user->penalty) {
            return back()->with('error', 'Payment exceeds penalty amount.');
        }

 
        $user->penalty -= $amountToPay;
        $user->save();


        Payment::create([
            'user_id' => $userId,
            'payment_amount' => $amountToPay,
        ]);

        return back()->with('success', 'Payment recorded successfully.');
    }
}

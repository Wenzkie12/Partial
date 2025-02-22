<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;


class PaymentController extends Controller
{
  
    public function index()
{

    $users = User::where('penalty', '>', 0)->get();

    $payments = Payment::orderBy('created_at', 'desc')->get();

    return view('staff.payment-section', compact('users', 'payments'));
}


    public function store(Request $request, $userId)
{
    $request->validate([
        'payment_amount' => 'required|numeric|min:1',
    ]);

    $user = User::findOrFail($userId);
    $paymentAmount = $request->payment_amount;

    if ($paymentAmount > $user->penalty) {
        return redirect()->back()->with('error', 'Payment amount exceeds penalty.');
    }


    do {
        $referenceNumber = str_pad(mt_rand(1000000000000, 9999999999999), 13, '0', STR_PAD_LEFT);
    } while (Payment::where('reference_number', $referenceNumber)->exists());

 
    $payment = Payment::create([
        'user_id' => $user->id,
        'payment_amount' => $paymentAmount,
        'reference_number' => $referenceNumber,
        'payment_date' => now(),
    ]);


    $user->penalty -= $paymentAmount;
    $user->save();


    Notification::create([
        'user_id' => $user->id,
        'transaction_id' => $payment->id,
        'message' => "Payment received: ₱{$paymentAmount}. Reference No: {$payment->reference_number}. Date: " . now()->format('Y-m-d H:i:s'),
    ]);

    return redirect()->back()->with('success', 'Payment successful.');
}


}

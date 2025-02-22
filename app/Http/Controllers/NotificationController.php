<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class NotificationController extends Controller
{
    public function index()
{
    $notifications = Notification::where('user_id', Auth::id())
                                 ->orderBy('created_at', 'desc')
                                 ->get();

 
    $payments = Payment::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

    return view('user.inbox', compact('notifications', 'payments'));
}

}

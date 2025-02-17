<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penalty;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalties = Penalty::with('user')->get(); // Fetch penalties with user info
        return view('staff.penalty-list', compact('penalties'));
    }
}

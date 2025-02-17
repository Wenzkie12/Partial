<?php

namespace App\Http\Controllers;

use App\Models\BookLog;
use Illuminate\Http\Request;

class BookLogController extends Controller
{
    public function index()
    {
        
        $bookLogs = BookLog::paginate(10); 

      
        return view('superadmin.booklog', compact('bookLogs'));
    }
}

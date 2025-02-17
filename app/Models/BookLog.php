<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'book_id', 'action', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Book model
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function index()
    {
        // Fetch the book log data and eager load the book title
        $bookLogs = BookLog::with('book')->get(); // Assuming `book` is the relationship name

        return view('superadmin.booklog', compact('bookLogs'));
    }
}

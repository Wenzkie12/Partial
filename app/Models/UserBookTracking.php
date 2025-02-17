<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBookTracking extends Model
{
    use HasFactory;

    protected $table = 'user_book_tracking';

    protected $fillable = [
        'user_id', 
        'book_id', 
        'status', 
        'reservation_date', 
        'claimed_at', 
        'returned_at', 
        'remaining_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBookTracking extends Model
{
    use HasFactory;

    protected $table = 'user_book_tracking'; // Fix the table name here

    protected $fillable = [
        'reservation_id', 'user_id', 'book_id', 'status',
        'reservation_date', 'claimed_at', 'returned_at', 'canceled_at'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}




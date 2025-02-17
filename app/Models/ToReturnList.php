<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToReturnList extends Model
{
    use HasFactory;

    protected $table = 'to_return_list';

    protected $fillable = [
        'user_id',
        'book_id',
        'claimed_at',
        'returned_at'
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

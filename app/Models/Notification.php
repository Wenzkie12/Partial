<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'transaction_id', 'message'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'transaction_id');
    }
}

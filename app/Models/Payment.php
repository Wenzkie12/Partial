<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'payment_amount', 'reference_number', 'payment_date'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->reference_number = self::generateReferenceNumber();
        });
    }

    private static function generateReferenceNumber()
    {
        do {
            $reference = str_pad(mt_rand(0, 9999999999999), 13, '0', STR_PAD_LEFT);
        } while (self::where('reference_number', $reference)->exists());

        return $reference;
    }
}


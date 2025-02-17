<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ReservationController;
use App\Models\ToReturnList;
use App\Models\Penalty;
use Carbon\Carbon;

// Default Artisan command
Artisan::command('inspire', function () {
    $this->comment(\Illuminate\Foundation\Inspiring::quote());
})->purpose('Display an inspiring quote');

// Command to clean expired reservations
Artisan::command('reservations:cleanup', function () {
    (new ReservationController)->removeExpiredReservations();
})->purpose('Remove expired reservations');

// Schedule the cleanup task
app(Schedule::class)->command('reservations:cleanup')->daily();



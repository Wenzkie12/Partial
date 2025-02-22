<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ReservationController;
use App\Models\ToReturnList;
use App\Models\Penalty;
use Carbon\Carbon;


Artisan::command('inspire', function () {
    $this->comment(\Illuminate\Foundation\Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('reservations:cleanup', function () {
    (new ReservationController)->removeExpiredReservations();
})->purpose('Remove expired reservations');

app(Schedule::class)->command('reservations:cleanup')->daily();



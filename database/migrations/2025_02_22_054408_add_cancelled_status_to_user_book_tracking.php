<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancelledStatusToUserBookTracking extends Migration
{
    public function up()
    {
        Schema::table('user_book_tracking', function (Blueprint $table) {
            $table->enum('status', ['pending', 'claimed', 'returned', 'canceled'])->default('pending')->change();
            $table->timestamp('canceled_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('user_book_tracking', function (Blueprint $table) {
            $table->enum('status', ['pending', 'claimed', 'returned'])->default('pending')->change();
            $table->dropColumn('canceled_at');
        });
    }
}

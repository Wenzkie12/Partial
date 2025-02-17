<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBookTrackingTable extends Migration
{
    public function up()
    {
        Schema::create('user_book_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'claimed', 'returned'])->default('pending');
            $table->date('reservation_date');
            $table->timestamp('claimed_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->string('remaining_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_book_tracking');
    }
}

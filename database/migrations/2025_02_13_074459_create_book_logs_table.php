<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('book_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->unsignedBigInteger('book_id')->nullable(); // Make book_id nullable
            $table->string('action');
            $table->string('description');
            $table->timestamps();

            // Foreign key without cascading delete (do not delete logs when book is deleted)
            $table->foreign('book_id')
                  ->references('id')->on('books')
                  ->nullOnDelete(); // Keep the log even if the book is deleted

            // Foreign key for user_id (do not delete logs when the user is deleted)
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->restrictOnDelete(); // Prevent log deletion if user is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('book_logs', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('book_logs');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Book ID
            $table->string('name'); // Name of the book
            $table->string('author'); // Author
            $table->year('date_published'); // Year Published
            $table->string('category'); // Category
            $table->integer('quantity'); // Quantity
            $table->timestamps(); // Created at and updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}

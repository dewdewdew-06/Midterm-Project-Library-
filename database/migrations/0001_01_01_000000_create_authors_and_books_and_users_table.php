<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id(); //PRIMARY KEY int id
            $table->string('name', 50); //string[50] name
            $table->integer('booksPublished'); //int booksPublished
        });

        Schema::create('books', function(Blueprint $table){
            $table->id(); //PRIMARY KEY int id
            $table->foreignId('authorID')->constrained('authors')->onDelete('cascade'); //FOREIGN KEY from authors.id
            $table->string('name', 50); //string[50] name
            $table->date('releaseDate'); //date releaseDate
            $table->string('genre', 50); //string[50] genre
            $table->integer('pages'); //int pages
        });

        Schema::create('users', function(Blueprint $table){
            $table->id(); //PRIMARY KEY int id
            $table->string('name', 50); //string[50] name
            $table->string('email', 50); //string[50] email
            $table->string('password', 255); //string[50] password
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('users');
    }
};
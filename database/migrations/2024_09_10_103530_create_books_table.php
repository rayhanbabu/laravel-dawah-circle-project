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
        Schema::create('books', function (Blueprint $table) {

            $table->id();

            $table->string('book_id')->unique();
            $table->integer('book_code');
            $table->unsignedBigInteger('publisher_id');
            $table->foreign('publisher_id')->references('id')->on('publishers');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members');

            $table->string('author_id');
            $table->integer('book_status')->default(1);

          

            $table->string('title');
            $table->text('desc')->nullable();
            $table->string('image')->nullable();
            $table->integer('serial')->nullable();

            $table->enum('gender',['Female','Male']);
            $table->integer('book_copy')->nullable();

            $table->string('page')->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

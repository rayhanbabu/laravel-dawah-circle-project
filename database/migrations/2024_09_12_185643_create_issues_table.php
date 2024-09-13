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
        Schema::create('issues', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('book_id');
            $table->foreign('book_id')->references('book_id')->on('books');

            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members');

            $table->integer('issue_status');
            $table->enum('gender',['Female','Male']);

            $table->timestamp('request_time')->nullable();
            $table->timestamp('return_time')->nullable();
            $table->timestamp('issue_time')->nullable();

            $table->date('retuested_date')->nullable();
            $table->date('return_date')->nullable();
            $table->date('issue_date')->nullable();

            $table->string('return_day')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};

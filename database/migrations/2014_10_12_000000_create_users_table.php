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

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            
            $table->enum('userType',['SupperAdmin','Admin','Staff']);

            $table->unsignedBigInteger('hall_id');
            $table->foreign('hall_id')->references('id')->on('halls');

            $table->integer('status')->default(1);
            $table->string('image')->nullable(); 
            $table->string('designation')->nullable();  
            $table->enum('gender',['Female','Male']); 
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('order_access')->nullable();  
            $table->rememberToken();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

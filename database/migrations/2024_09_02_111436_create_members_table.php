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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('emailmd5');
            $table->string('phone')->unique();    
            $table->integer('registration')->unique();

            $table->unsignedBigInteger('hall_id');
            $table->foreign('hall_id')->references('id')->on('halls');

           
            $table->string('password');
            $table->integer('email_verify_status');
            $table->integer('status')->default(1);
            $table->string('address')->nullable();
            $table->string('department')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('agent_type')->nullable();
            $table->enum('gender',['Female','Male']);
            $table->enum('member_category',['Offline','Online']);
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
        Schema::dropIfExists('members');
    }
};

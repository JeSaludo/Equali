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
        Schema::create('admission_exams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('raw_score');
            $table->bigInteger('percentage');
            
            $table->unsignedBigInteger('user_id');          
            $table->string('status')->nullable();
         

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_exams');
    }
};

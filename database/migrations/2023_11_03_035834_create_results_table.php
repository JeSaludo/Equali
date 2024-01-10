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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('measure_a_score', 5, 2)->nullable();
            $table->decimal('measure_b_score', 5, 2)->nullable();
            $table->decimal('measure_c_score', 5, 2)->nullable();
            $table->decimal('admission_score', 5, 2)->nullable();
            $table->bigInteger('total_exam_score')->nullable();
            $table->decimal('scaled_exam_score')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};

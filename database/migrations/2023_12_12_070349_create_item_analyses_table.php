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
        Schema::create('item_analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');   
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->decimal('difficulty_index', 5, 2);          
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_analyses');
    }
};

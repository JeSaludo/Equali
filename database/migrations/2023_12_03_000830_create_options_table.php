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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('qualifying_passing_score');
            $table->decimal('qualified_student_passing_average');   // for average?       
            $table->bigInteger('qualifying_number_of_items');// 
            $table->bigInteger('qualifying_timer');
            $table->bigInteger('slot_per_day')->default(30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};

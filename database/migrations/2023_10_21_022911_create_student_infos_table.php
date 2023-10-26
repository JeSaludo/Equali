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
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');         

            $table->string('address');
            $table->string('course');
            $table->string('school_address');
            $table->string('school_last_attended');
            $table->string('year_graduated');
           
            $table->decimal('gpa');
            $table->string('academic_track');

            $table->boolean('has_laptop')->default(0);
            $table->boolean('has_computer')->default(0);

            $table->boolean('has_smartphone')->default(0);
            $table->boolean('has_tablet')->default(0);

            $table->enum('internet_status', ['Stable','Not Stable', 'None'])->default('None');

            $table->string('interviewNo1')->nullable();
            $table->string('interviewNo2')->nullable();
            $table->string('interviewNo3')->nullable();
            $table->string('interviewNo4')->nullable();
            $table->string('interviewNo5')->nullable();

            $table->boolean('interview')->default(false);          
            $table->dateTime('interview_date')->nullable();
            $table->decimal('average_score', 5, 2);
            $table->string('remarks')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_infos');
    }
};

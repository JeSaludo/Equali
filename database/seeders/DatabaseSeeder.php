<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();
        // \App\Models\AdmissionExam::factory(10)->create();
        
        \App\Models\User::factory()->create([
            'first_name' => null,
            'last_name' => null,
            'username' => null,
            'contact_number' => null,
            'status' => null,
            'email' => 'equali.programhead@gmail.com',
            'password' => 'programhead12345',
            'role' => 'ProgramHead',
            'remember_token' => null,
        ]);

        \App\Models\User::factory()->create([
            'first_name' => null,
            'last_name' => null,
            'username' => null,
            'contact_number' => null,
            'status' => null,
            'email' => 'equali.dean@gmail.com',
            'password' => 'dean12345',
            'role' => 'Dean',
            'remember_token' => null,
        ]);

        \App\Models\User::factory()->create([
            'first_name' => null,
            'last_name' => null,
            'username' => null,
            'contact_number' => null,
            'status' => null,
            'email' => 'equali.proctor@gmail.com',
            'password' => 'proctor12345',
            'role' => 'Proctor',
            'remember_token' => null,
        ]);
        Option::factory()->count(1)->create();


        // \App\Models\Question::factory(10)->create()->each(function ($question) {
        //     // Create 4 regular choices
        //     $choices = \App\Models\Choice::factory(3)->create(['question_id' => $question->id]);

        //     // Add the correct answer as the 4th choice
        //     $correctChoice = \App\Models\Choice::factory()->correctAnswer()->create(['question_id' => $question->id]);
        //     $choices->push($correctChoice);

        //     // Shuffle the choices array to randomize the correct answer position
        //     $shuffledChoices = $choices->shuffle();

        //     // Update the is_correct flag for the shuffled choices
        //     $shuffledChoices->each(function ($choice, $index) {
        //         $choice->update(['is_correct' => $index === 0]);
        //     });
    
        //     // Create the "no answer" choice
        //     \App\Models\Choice::factory()->noAnswer()->create(['question_id' => $question->id]);
        // });
    }
}

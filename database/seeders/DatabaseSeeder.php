<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();
        //\App\Models\AdmissionExam::factory(10)->create();
        \App\Models\User::factory()->create([
            'first_name' => null,
            'last_name' => null,
            'username' => null,
            'contact_number' => null,
            'status' => null,
            'email' => 'admin@test.com',
            'password' => 'admin12345',
            'role' => 'ProgramHead',
            'remember_token' => null,
        ]);
    }
}

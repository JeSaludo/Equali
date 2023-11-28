<?php

namespace Database\Factories;

use App\Models\AdmissionExam;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdmissionExam>
 */
class AdmissionExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = AdmissionExam::class;
    public function definition(): array
    {
        $userIds = \App\Models\User::pluck('id')->toArray();

    if (empty($userIds)) {
        // Handle the case where there are no users
        return [
            'score' => fake()->numberBetween(0, 60),
            'total_score' => fake()->numberBetween(0, 60),
            'user_id' => null,
            'status' => 'Passed',
        ];
    }

    $userId = fake()->unique()->randomElement($userIds);

    return [
        'score' => fake()->numberBetween(0, 60),
        'total_score' => fake()->numberBetween(0, 60),
        'user_id' => $userId,
        'status' => 'Passed',
    ];
    }
}
